@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/langstyle.css') }}">
@endsection

@section('title', 'Tourism - Fiji Web Directory')

@section('content')
    <section class="departments">

        <a href="{{ route('categories.listings', ['category' => 'tourism', 'subcategory' => 'travel-agencies']) }}" class="department">
            <h3>Travel Agencies</h3>
            <p>Companies that provide travel planning, holiday packages, and booking services. They connect tourists with Fiji's destinations and experiences.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'tourism', 'subcategory' => 'tour-operators']) }}" class="department">
            <h3>Tour Operators</h3>
            <p>Adventure and eco-tour providers offering guided tours and cultural experiences. They create memorable visitor experiences while supporting local communities.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'tourism', 'subcategory' => 'hotels-accommodations']) }}" class="department">
            <h3>Hotels & Accommodations</h3>
            <p>Resorts, hotels, and lodges across Fiji that cater to domestic and international travelers. They provide comfort, hospitality, and access to Fiji's attractions.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'tourism', 'subcategory' => 'tourist-attractions']) }}" class="department">
            <h3>Tourist Attractions</h3>
            <p>Natural, historical, and cultural sites popular with visitors. These destinations showcase Fiji's beauty, heritage, and traditions.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'tourism', 'subcategory' => 'cultural-tourism']) }}" class="department">
            <h3>Cultural Tourism</h3>
            <p>Activities and centers highlighting traditional Fijian music, dance, and customs. Cultural tourism gives visitors an authentic glimpse into Fiji's way of life.</p>
        </a>

    </section>
@endsection