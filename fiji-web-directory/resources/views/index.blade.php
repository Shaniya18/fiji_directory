@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/home.css') }}">
@endsection

@section('title', 'Home - Fiji Web Directory')

@section('content')
    <!-- Page Banner -->
    <div id="page-banner-container"
        style="background-image: url('{{ asset('images/about-page-banner.gif') }}'); background-size: cover;">
        <div id="page-banner-box" class="aboutus-bannerbox">
            <h1 id="aboutus-banner-title">Welcome to Fiji Web Directory</h1>
            <hr id="aboutus-banner-separator">
        </div>
    </div>

    <!-- Introduction -->
    <div class="intro">
        <center>
            <p>This online directory is a project for ITC307, part of the Bachelor of Information Technology program at the University of Fiji, Saweni Campus.</p>

            <p>Fiji Web Directory is a comprehensive, searchable online directory designed to list and categorize organizations and companies across Fiji. It provides a structured framework for easy navigation and access to relevant information.</p>

            <p>The directory serves as a central hub for discovering public services, private businesses, and non-profit organizations throughout the country. By providing detailed listings, it enhances online visibility and improves access to essential services in Fiji.</p>

            <p>Users can search for businesses, educational institutions, health services, and other organizations easily through categories or search functionality. Each listing provides contact details, locations, and relevant information for easy engagement.</p>

            <p>Businesses and organizations can submit their listings to increase their visibility and connect with more people in Fiji. Our goal is to support digital accessibility and provide a reliable reference for all users seeking services across the nation.</p>
        </center>
    </div>

    <!-- Call to Action -->
    <div class="cta-section">
        <h2>Get Your Organization Listed</h2>
        <p>Submit your business or organization to Fiji Web Directory and reach more people easily.</p>
        <a href="{{ route('submit') }}" class="cta-button" style="background: #4caf50; color: white; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-weight: 600;">Submit Listing</a>
    </div>
@endsection