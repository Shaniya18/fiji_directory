@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/rep.css') }}">
@endsection

@section('title', 'Reports - Admin Dashboard')

@section('content')
    <div id="reports-main-container">
        <div id="reports-container1">
            <h2>All Reports:</h2>
            <hr>
            
            <table id="reports-options" cellspacing="0">
                <tr>
                    <td>
                        <label for="" id="startdate-label">Start Date:</label>
                        <br>
                        <input type="datetime-local" class="reports-container-dateinput" name="" id="">
                    </td>
                    
                    <td>
                        <label for="" id="enddate-label">End Date:</label>
                        <br>
                        <input type="datetime-local" class="reports-container-dateinput" name="" id="">
                    </td>
                    
                    <td>
                        <label for="" id="category-label">Category:</label>
                        <br>
                        <select name="" id="categories-select-reports-dropdown">
                            <option value="">Select A Category</option>
                            @foreach($listingsByCategory as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td style="padding-right: 500px;">
                        <label for="" id="moreoptions-label">More Options:</label>
                        <br>
                        <<a href="{{ route('admin.export.csv') }}" class="moreoptions-btn" style="text-decoration: none; display: inline-block; padding: 8px 15px;">Export CSV</a>
                </tr>
            </table>
        </div>

        <div id="reports-container2">
            <div id="listingspercategory-box">
                <h2>Listings Per Category:</h2>
                <hr>
                <div id="listingspercategory-graph">
                    {{-- Graph placeholder - you can add Chart.js here later --}}
                    <table style="width: 100%; margin-top: 20px;">
                        @foreach($listingsByCategory as $category)
                            @if($category->listings_count > 0)
                                <tr>
                                    <td style="padding: 8px;">{{ $category->name }}</td>
                                    <td style="padding: 8px;">
                                        <div style="background: #4CAF50; height: 20px; width: {{ $category->listings_count * 20 }}px;"></div>
                                    </td>
                                    <td style="padding: 8px;">{{ $category->listings_count }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>

            <div id="topsubmittedcategories-box">
                <h2>Top Submitted Categories:</h2>
                <hr>
                <div id="topsubmittedcategories-graph">
                    <table style="width: 100%; margin-top: 20px;">
                        @php
                            $topCategories = $listingsByCategory->sortByDesc('listings_count')->take(5);
                        @endphp
                        @foreach($topCategories as $category)
                            @if($category->listings_count > 0)
                                <tr>
                                    <td style="padding: 8px;">{{ $category->name }}</td>
                                    <td style="padding: 8px; text-align: right;"><strong>{{ $category->listings_count }}</strong></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div id="reports-container3">
            <h2 id="topvisitedlistings-title">Top Visited Listings:</h2>
            <hr id="topvisitedlistings-separator">
            <table cellspacing="0" id="topvisitedlistings-table">
                <tr>  
                    <td style="font-weight: bold;">ID</td>
                    <td style="font-weight: bold;">Title:</td>
                    <td style="font-weight: bold;">Category:</td>
                    <td style="font-weight: bold;">Rating:</td>
                </tr>

                @php
                    $topListings = \App\Models\Listing::with('category')
                        ->orderBy('average_rating', 'desc')
                        ->take(5)
                        ->get();
                @endphp

                @forelse($topListings as $listing)
                    <tr>
                        <td>{{ $listing->id }}</td>
                        <td>{{ $listing->business_name }}</td>
                        <td>{{ $listing->category->name }}</td>
                        <td>{{ number_format($listing->average_rating, 1) }} ⭐</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 20px; color: #999;">No listings yet</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <div id="reports-container4">
            <div id="top-visited-listings-sect">
                <h2 id="submissionlogs-title">Submission Logs:</h2>
                <hr id="submissionlogs-separator">
                <table cellspacing="0" id="submissionlogs-table">
                    <tr>
                        <td style="font-weight: bold;">ID:</td>
                        <td style="font-weight: bold;">Title:</td>
                        <td style="font-weight: bold;">Category:</td>
                        <td style="font-weight: bold;">Region</td>
                        <td style="font-weight: bold;">Email:</td>
                        <td style="font-weight: bold;">Status:</td>
                        <td style="font-weight: bold;">Submission Date:</td>
                    </tr>

                    @forelse($recentSubmissions as $submission)
                        <tr>
                            <td>{{ $submission->id }}</td>
                            <td>{{ $submission->business_name }}</td>
                            <td>{{ $submission->category->name }}</td>
                            <td>{{ $submission->region ?? 'N/A' }}</td>
                            <td>{{ $submission->contact_email }}</td>
                            <td style="color: {{ $submission->status == 'approved' ? 'green' : ($submission->status == 'rejected' ? 'red' : 'orange') }};">
                                {{ ucfirst($submission->status) }}
                            </td>
                            <td>{{ $submission->created_at->format('d/m/y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px; color: #999;">No submissions yet</td>
                        </tr>
                    @endforelse
                </tab