@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/langstyle.css') }}">
@endsection

@section('title', 'Services - Fiji Web Directory')

@section('content')
    <section class="departments">

        <a href="{{ route('categories.listings', ['category' => 'services', 'subcategory' => 'public-utilities']) }}" class="department">
            <h3>Public Utilities</h3>
            <p>Essential services providing electricity, water, and waste management. These utilities are fundamental to daily life and economic activity in Fiji.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'services', 'subcategory' => 'postal-courier-services']) }}" class="department">
            <h3>Postal & Courier Services</h3>
            <p>Mail delivery and package shipping services connecting communities locally and internationally. They facilitate communication and commerce.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'services', 'subcategory' => 'transportation-logistics']) }}" class="department">
            <h3>Transportation & Logistics</h3>
            <p>Bus services, freight companies, and logistics providers moving people and goods. They support mobility and trade throughout the islands.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'services', 'subcategory' => 'it-communication-services']) }}" class="department">
            <h3>IT & Communication Services</h3>
            <p>Internet providers, telecommunications companies, and tech support services. They enable digital connectivity and technological advancement.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'services', 'subcategory' => 'cleaning-maintenance']) }}" class="department">
            <h3>Cleaning & Maintenance</h3>
            <p>Professional cleaning, facility management, and maintenance contractors. They ensure cleanliness and upkeep of buildings and spaces.</p>
        </a>

    </section>
@endsection