<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AdminController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/{subcategory}', [CategoryController::class, 'listings'])->name('categories.listings');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
// Auth routes
Route::get('/signin', [AuthController::class, 'showSignin'])->name('login');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::get('/create', [AuthController::class, 'showCreate'])->name('create');
Route::post('/create', [AuthController::class, 'create']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Submissions
Route::get('/submit', [SubmissionController::class, 'show'])->name('submit');
Route::post('/submit', [SubmissionController::class, 'store']);

// Listings
Route::get('/listing', [ListingController::class, 'index'])->name('listing');
Route::get('/listing/{id}', [ListingController::class, 'show'])->name('listing.show');
Route::post('/listing/{id}/review', [ListingController::class, 'submitReview'])->name('listing.review')->middleware('auth');

// Admin routes (protected)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    Route::get('/submissions', [AdminController::class, 'submissions'])->name('admin.submissions');
    Route::post('/submissions/{id}/approve', [AdminController::class, 'approveSubmission'])->name('admin.submissions.approve');
    Route::post('/submissions/{id}/reject', [AdminController::class, 'rejectSubmission'])->name('admin.submissions.reject');
    
    Route::get('/listings', [AdminController::class, 'listings'])->name('admin.listings');
    Route::get('/listings/{id}/edit', [AdminController::class, 'editListing'])->name('admin.listings.edit');
    Route::put('/listings/{id}', [AdminController::class, 'updateListing'])->name('admin.listings.update');
    Route::delete('/listings/{id}', [AdminController::class, 'deleteListing'])->name('admin.listings.delete');
    
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/export-csv', [AdminController::class, 'exportCSV'])->name('admin.export.csv');
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('admin.contacts');
    Route::delete('/contacts/{id}', [AdminController::class, 'deleteContact'])->name('admin.contacts.delete');
}
);
