@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/search.css') }}">
@endsection

@section('title', 'Listings - Fiji Web Directory')

@section('content')
    <div id="search-container2">
        <h2>All Listings</h2>
        <hr>

        @forelse($listings as $listing)
            <div class="listing-items-cols">
                <div class="items-cols-left">
                    <img src="{{ asset('imgs/fiji-national-university.jpg') }}" alt="{{ $listing->business_name }}">
                </div>
                <div class="items-cols-mid">
                    <h3>{{ $listing->business_name }}</h3>
                    <hr style="width: 10%; margin-left: 0px;">
                    <p>{{ Str::limit($listing->description, 150) }}</p>
                    <label>Location:</label>
                    <br>
                    <span>{{ $listing->region ?? 'N/A' }}</span>
                    <br>
                    <label>Category:</label>
                    <br>
                    <span>{{ $listing->category->name }}</span>
                    @if($listing->tags)
                        <br>
                        <label>Tags:</label>
                        <br>
                        <span>{{ $listing->tags }}</span>
                    @endif
                    <br>
                    <label>Rating:</label>
                    <br>
                    <span>{{ number_format($listing->average_rating, 1) }} ⭐ ({{ $listing->reviews->count() }} reviews)</span>
                </div>
                <div class="items-cols-right">
                    <a href="{{ route('listing.show', $listing->id) }}">See More</a>
                </div>
            </div>
        @empty
            <p style="text-align: center; padding: 50px;">No listings available yet.</p>
        @endforelse

        <div style="margin: 30px 0; text-align: center;">
            {{ $listings->links() }}
        </div>
    </div>
@endsection