<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function show()
    {
        $categories = Category::whereNull('parent_category_id')->get();
        return view('submit', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_email' => 'required|email',
            'phone_number' => 'required|string|max:50',
            'website_url' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
            'region' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
        ]);

        Submission::create([
            'business_name' => $request->business_name,
            'description' => $request->description,
            'contact_email' => $request->contact_email,
            'phone_number' => $request->phone_number,
            'website_url' => $request->website_url,
            'category_id' => $request->category_id,
            'region' => $request->region,
            'tags' => $request->tags,
            'status' => 'pending',
            'user_id' => Auth::id() ?? 1, // Guest submission default user
        ]);

        return redirect()->route('home')->with('success', 'Your submission has been received and is pending approval.');
    }
}