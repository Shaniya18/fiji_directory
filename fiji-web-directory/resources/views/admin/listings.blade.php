@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/approve.css') }}">
@endsection

@section('title', 'Manage Listings - Admin')

@section('content')
    <div class="container">
        <section id="edit-delete-section">
            <h2>Manage All Listings</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Business Name</th>
                        <th>Category</th>
                        <th>Region</th>
                        <th>Rating</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listings as $listing)
                        <tr>
                            <td>{{ $listing->id }}</td>
                            <td>{{ $listing->business_name }}</td>
                            <td>{{ $listing->category->name }}</td>
                            <td>{{ $listing->region ?? 'N/A' }}</td>
                            <td>{{ number_format($listing->average_rating, 1) }} ⭐</td>
                            <td>
                                <a href="{{ route('admin.listings.edit', $listing->id) }}" class="btn edit-btn">Edit</a>
                                <form action="{{ route('admin.listings.delete', $listing->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn delete-btn" onclick="return confirm('Delete this listing?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px;">No listings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
@endsection