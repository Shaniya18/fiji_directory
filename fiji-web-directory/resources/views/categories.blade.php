@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/langstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/card.css') }}">
@endsection

@section('title', 'Categories - Fiji Web Directory')

@section('content')
    <section class="team">
        <h1>Main Categories</h1>
        <div class="team-cards">

            <a href="{{ route('categories.show', 'government') }}" style="text-decoration: none; color: inherit;">
                <div class="team-card">
                    <img src="{{ asset('images/gov.jpg') }}" alt="Government Building">
                    <h3>Government</h3>
                    <p>Explore ministries, departments, and public services of Fiji.</p>
                </div>
            </a>

            <a href="{{ route('categories.show', 'education') }}" style="text-decoration: none; color: inherit;">
                <div class="team-card">
                    <img src="{{ asset('images/edu.jpg') }}" alt="Education Category">
                    <h3>Education</h3>
                    <p>Schools, universities, and training institutions across Fiji.</p>
                </div>
            </a>

            <a href="{{ route('categories.show', 'health') }}" style="text-decoration: none; color: inherit;">
                <div class="team-card">
                    <img src="{{ asset('images/heal.jpg') }}" alt="Health Services">
                    <h3>Health</h3>
                    <p>Hospitals, clinics, and health organizations nationwide.</p>
                </div>
            </a>

            <a href="{{ route('categories.show', 'business') }}" style="text-decoration: none; color: inherit;">
                <div class="team-card">
                    <img src="{{ asset('images/bus.jpg') }}" alt="Business">
                    <h3>Business</h3>
                    <p>Retail, manufacturing, and corporate services across Fiji.</p>
                </div>
            </a>

            <a href="{{ route('categories.show', 'environment') }}" style="text-decoration: none; color: inherit;">
                <div class="team-card">
                    <img src="{{ asset('images/env.jpg') }}" alt="Environment and NGOs">
                    <h3>Environment and NGOs</h3>
                    <p>Conservation, climate initiatives, and sustainable projects.</p>
                </div>
            </a>

            <a href="{{ route('categories.show', 'tourism') }}" style="text-decoration: none; color: inherit;">
                <div class="team-card">
                    <img src="{{ asset('images/tour.jpg') }}" alt="Tourism">
                    <h3>Tourism</h3>
                    <p>Travel agencies, hotels, and tourist attractions.</p>
                </div>
            </a>

            <a href="{{ route('categories.show', 'media') }}" style="text-decoration: none; color: inherit;">
                <div class="team-card">
                    <img src="{{ asset('images/media.jpg') }}" alt="Media">
                    <h3>Media</h3>
                    <p>Television, radio, newspapers, and online news portals.</p>
                </div>
            </a>

            <a href="{{ route('categories.show', 'law') }}" style="text-decoration: none; color: inherit;">
                <div class="team-card">
                    <img src="{{ asset('images/law.jpg') }}" alt="Law and Justice">
                    <h3>Law and Justice</h3>
                    <p>Courts, police, legal aid, and human rights organizations.</p>
                </div>
            </a>

            <a href="{{ route('categories.show', 'services') }}" style="text-decoration: none; color: inherit;">
                <div class="team-card">
                    <img src="{{ asset('images/serv.jpg') }}" alt="Services">
                    <h3>Services</h3>
                    <p>Utilities, postal services, transportation, and IT services.</p>
                </div>
            </a>

        </div>
    </section>
@endsection