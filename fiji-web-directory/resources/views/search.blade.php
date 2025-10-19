@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/search.css') }}">
@endsection

@section('title', 'Search - Fiji Web Directory')

@section('content')
    <div id="search-container1">
        <h2>Search Listings:</h2>
        <hr>
        
        <form action="{{ route('search') }}" method="GET">
            <input type="text" name="query" placeholder="Enter search keywords" 
                   id="search-inputbox" value="{{ request('query') }}">

            <select name="category_id" id="search-select-category-dropdown">
                <option value="">All Categories</option>
                @php
                    $categories = \App\Models\Category::whereNull('parent_category_id')->get();
                @endphp
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="region" id="search-select-region-dropdown">
                <option value="">All Islands</option>
                <option value="Viti Levu" {{ request('region') == 'Viti Levu' ? 'selected' : '' }}>Viti Levu</option>
                <option value="Vanua Levu" {{ request('region') == 'Vanua Levu' ? 'selected' : '' }}>Vanua Levu</option>
                <option value="Other Islands" {{ request('region') == 'Other Islands' ? 'selected' : '' }}>Other Islands</option>
            </select>

            <button type="submit" style="padding: 10px 20px; margin-top: 10px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Search</button>
        </form>
    </div>

    <div id="search-container2">
        <h2>Search Results</h2>
        <hr>

        @php
            $query = request('query');
            $categoryId = request('category_id');
            $region = request('region');
            
            $listings = \App\Models\Listing::query()
                ->when($query, function($q) use ($query) {
                    $q->where('business_name', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%")
                      ->orWhere('tags', 'LIKE', "%{$query}%");
                })
                ->when($categoryId, function($q) use ($categoryId) {
                    $q->where('category_id', $categoryId);
                })
                ->when($region, function($q) use ($region) {
                    $q->where('region', $region);
                })
                ->with('category')
                ->paginate(10);
        @endphp

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
                </div>
                <div class="items-cols-right">
                    <a href="{{ route('listing.show', $listing->id) }}">See more</a>
                </div>
            </div>
        @empty
            <p style="text-align: center; padding: 50px; color: #999;">
                @if($query || $categoryId || $region)
                    No results found. Try different search terms.
                @else
                    Enter search terms above to find listings.
                @endif
            </p>
        @endforelse

        @if($listings->count() > 0)
            <div style="margin: 30px 0; text-align: center;">
                {{ $listings->links() }}
            </div>
        @endif
    </div>
@endsection