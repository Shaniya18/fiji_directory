<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_category_id')->get();
        return view('categories', compact('categories'));
    }

    public function show($slug)
    {
        // Map URL slugs to category views
        $viewMap = [
            'government' => 'government',
            'education' => 'education',
            'health' => 'health',
            'business' => 'business',
            'environment' => 'env',
            'tourism' => 'tourism',
            'media' => 'media',
            'law' => 'law',
            'services' => 'service',
        ];

        if (isset($viewMap[$slug])) {
            $category = Category::where('name', 'like', '%' . ucfirst($slug) . '%')->first();
            $subcategories = $category ? $category->children : collect();
            
            return view($viewMap[$slug], compact('category', 'subcategories'));
        }

        abort(404);
    }

    public function listings($categorySlug, $subcategorySlug = null)
    {
        // Find parent category
        $parentCategory = Category::whereNull('parent_category_id')
            ->where(function($query) use ($categorySlug) {
                $query->where('name', 'like', '%' . ucfirst($categorySlug) . '%')
                      ->orWhere('name', 'like', '%' . ucfirst(str_replace('-', ' ', $categorySlug)) . '%');
            })
            ->first();
        
        if (!$parentCategory) {
            abort(404, 'Parent category not found');
        }
        
        // Convert slug to title case with spaces
        $subcategoryName = ucwords(str_replace('-', ' ', $subcategorySlug));
        
        // Try multiple matching strategies
        $subcategory = Category::where('parent_category_id', $parentCategory->id)
            ->where(function($query) use ($subcategoryName, $subcategorySlug) {
                // Try exact match with spaces
                $query->where('name', 'like', '%' . $subcategoryName . '%')
                      // Try with & symbol
                      ->orWhere('name', 'like', '%' . str_replace(' ', ' & ', $subcategoryName) . '%')
                      // Try original slug
                      ->orWhere('name', 'like', '%' . str_replace('-', '%', $subcategorySlug) . '%');
            })
            ->first();
        
        if (!$subcategory) {
            // Debug: show available subcategories
            $available = Category::where('parent_category_id', $parentCategory->id)
                ->pluck('name')
                ->implode(', ');
            abort(404, 'Subcategory "' . $subcategoryName . '" not found. Available: ' . $available);
        }
        
        // Get listings for this subcategory
        $listings = Listing::where('category_id', $subcategory->id)
            ->with('category')
            ->paginate(10);
        
        return view('listing', compact('listings', 'subcategory'));
    }
}