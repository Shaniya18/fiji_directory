@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/approve.css') }}">
@endsection

@section('title', 'Admin Dashboard - Fiji Web Directory')

@section('content')
    <div class="container" style="padding: 20px;">
        <h1>Admin Dashboard</h1>
        <hr>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin: 30px 0;">
            <div style="background: #2196F3; color: white; padding: 30px; border-radius: 8px; text-align: center;">
                <h2 style="margin: 0; font-size: 48px;">{{ $pendingSubmissions }}</h2>
                <p style="margin: 10px 0 0 0;">Pending Submissions</p>
                <a href="{{ route('admin.submissions') }}" style="color: white; text-decoration: underline;">View All</a>
            </div>

            <div style="background: #4CAF50; color: white; padding: 30px; border-radius: 8px; text-align: center;">
                <h2 style="margin: 0; font-size: 48px;">{{ $approvedListings }}</h2>
                <p style="margin: 10px 0 0 0;">Approved Listings</p>
                <a href="{{ route('admin.listings') }}" style="color: white; text-decoration: underline;">Manage</a>
            </div>

            <div style="background: #FF9800; color: white; padding: 30px; border-radius: 8px; text-align: center;">
                <h2 style="margin: 0; font-size: 48px;">{{ $totalCategories }}</h2>
                <p style="margin: 10px 0 0 0;">Total Categories</p>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <h2>Quick Actions</h2>
            <div style="display: flex; gap: 15px; margin-top: 15px;">
                <a href="{{ route('admin.submissions') }}" class="btn approve-btn">Review Submissions</a>
                <a href="{{ route('admin.listings') }}" class="btn edit-btn">Manage Listings</a>
                <a href="{{ route('admin.reports') }}" class="btn" style="background: #9C27B0;">View Reports</a>
                <a href="{{ route('admin.contacts') }}" class="btn" style="background: #FF9800;">Contact Messages</a>
            </div>
        </div>
    </div>
@endsection