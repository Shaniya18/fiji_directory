@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/table.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/dlist.css') }}">
@endsection

@section('title', $listing->business_name . ' - Fiji Web Directory')

@section('content')
    <div id="listing-container">
        <h1>{{ $listing->business_name }}</h1>
        <p class="listing-description">{{ $listing->description }}</p>

        @if($listing->website_url)
            <p class="listing-link">
                🌐 <a href="{{ $listing->website_url }}" target="_blank">Visit Website</a>
            </p>
        @endif

        <div style="margin: 20px 0;">
            <strong>Category:</strong> {{ $listing->category->name }}<br>
            <strong>Email:</strong> {{ $listing->contact_email }}<br>
            <strong>Phone:</strong> {{ $listing->phone_number }}<br>
            @if($listing->region)
                <strong>Region:</strong> {{ $listing->region }}<br>
            @endif
            <strong>Rating:</strong> {{ number_format($listing->average_rating, 1) }} ⭐
        </div>

        <div id="reviews-section">
            <h2>User Reviews ({{ $listing->reviews->count() }})</h2>
            
            @forelse($listing->reviews as $review)
                <div class="review">
                    <p>
                        <strong>{{ $review->user ? $review->user->username : 'Anonymous' }}:</strong> 
                        {{ str_repeat('⭐', $review->rating) }}
                        <br>
                        "{{ $review->comment }}"
                        <br>
                        <small style="color: #999;">{{ $review->created_at->format('M d, Y') }}</small>
                    </p>
                </div>
            @empty
                <p>No reviews yet. Be the first to review!</p>
            @endforelse
        </div>

        <div id="review-form-section">
            <h3>Leave a Review</h3>
            
            @auth
                <form action="{{ route('listing.review', $listing->id) }}" method="POST" id="review-form">
                    @csrf
                    
                    <label for="rating">Rating:</label>
                    <select id="rating" name="rating" required>
                        <option value="">Choose</option>
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Very Good</option>
                        <option value="3">3 - Good</option>
                        <option value="2">2 - Fair</option>
                        <option value="1">1 - Poor</option>
                    </select>

                    <label for="comment">Comment:</label>
                    <textarea id="comment" name="comment" rows="4" placeholder="Write your feedback..." required></textarea>

                    <button type="submit" class="submit-btn">Submit Review</button>
                </form>
            @else
                <p id="login-prompt">
                    You must be <a href="{{ route('signin') }}">signed in</a> to leave a review.
                </p>
            @endauth
        </div>
    </div>
@endsection