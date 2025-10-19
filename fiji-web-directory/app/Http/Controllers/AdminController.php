<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Listing;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

        $pendingSubmissions = Submission::where('status', 'pending')->count();
        $approvedListings = Listing::count();
        $totalCategories = Category::count();
        
        return view('admin.dashboard', compact('pendingSubmissions', 'approvedListings', 'totalCategories'));
    }

    public function submissions()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

        $submissions = Submission::with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.submissions', compact('submissions'));
    }

    public function approveSubmission($id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

        $submission = Submission::findOrFail($id);
        
        $listing = Listing::create([
            'business_name' => $submission->business_name,
            'description' => $submission->description,
            'contact_email' => $submission->contact_email,
            'phone_number' => $submission->phone_number,
            'website_url' => $submission->website_url,
            'region' => $submission->region,
            'tags' => $submission->tags,
            'category_id' => $submission->category_id,
            'user_id' => $submission->user_id,
            'average_rating' => 0,
        ]);

        $submission->update(['status' => 'approved']);

        return redirect()->route('admin.submissions')->with('success', 'Submission approved and listing created.');
    }

    public function rejectSubmission($id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

        $submission = Submission::findOrFail($id);
        $submission->update(['status' => 'rejected']);

        return redirect()->route('admin.submissions')->with('success', 'Submission rejected.');
    }

    public function listings()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

        $listings = Listing::with(['category', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.listings', compact('listings'));
    }

    public function editListing($id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

        $listing = Listing::findOrFail($id);
        $categories = Category::all();
        
        return view('admin.edit-listing', compact('listing', 'categories'));
    }

    public function updateListing(Request $request, $id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

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

        $listing = Listing::findOrFail($id);
        $listing->update($request->all());

        return redirect()->route('admin.listings')->with('success', 'Listing updated successfully.');
    }

    public function deleteListing($id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

        $listing = Listing::findOrFail($id);
        $listing->delete();

        return redirect()->route('admin.listings')->with('success', 'Listing deleted successfully.');
    }

    public function reports()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

        $totalListings = Listing::count();
        $listingsByCategory = Category::withCount('listings')->get();
        $recentSubmissions = Submission::orderBy('created_at', 'desc')->take(10)->get();
        
        return view('admin.reports', compact('totalListings', 'listingsByCategory', 'recentSubmissions'));
    }

    public function exportCSV()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

        $submissions = Submission::with('category')->get();
        
        $filename = "submissions_" . date('Y-m-d') . ".csv";
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        fputcsv($output, ['ID', 'Business Name', 'Category', 'Region', 'Email', 'Status', 'Date']);
        
        foreach ($submissions as $submission) {
            fputcsv($output, [
                $submission->id,
                $submission->business_name,
                $submission->category->name,
                $submission->region,
                $submission->contact_email,
                $submission->status,
                $submission->created_at->format('Y-m-d')
            ]);
        }
        
        fclose($output);
        exit;
    }

    public function contacts()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

        $contacts = Contact::orderBy('created_at', 'desc')->get();
        
        return view('admin.contacts', compact('contacts'));
    }

    public function deleteContact($id)
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }

        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts')->with('success', 'Contact message deleted.');
    }
}