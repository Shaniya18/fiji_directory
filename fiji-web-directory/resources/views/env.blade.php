@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/langstyle.css') }}">
@endsection

@section('title', 'Environment & NGOs - Fiji Web Directory')

@section('content')
    <section class="departments">

        <a href="{{ route('categories.listings', ['category' => 'environment', 'subcategory' => 'environmental-protection-organizations']) }}" class="department">
            <h3>Environmental Protection Organizations</h3>
            <p>Groups dedicated to conservation, environmental law, and sustainability education. They work to safeguard Fiji's land, air, and water resources.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'environment', 'subcategory' => 'climate-change-initiatives']) }}" class="department">
            <h3>Climate Change Initiatives</h3>
            <p>Programs and networks addressing the impacts of rising seas, extreme weather, and climate adaptation. Fiji plays a leading role in climate advocacy across the Pacific.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'environment', 'subcategory' => 'sustainable-agriculture']) }}" class="department">
            <h3>Sustainable Agriculture</h3>
            <p>Farmer groups and cooperatives promoting organic, eco-friendly, and resilient farming practices. They strengthen food security and reduce environmental impact.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'environment', 'subcategory' => 'renewable-energy-projects']) }}" class="department">
            <h3>Renewable Energy Projects</h3>
            <p>Companies and initiatives developing solar, wind, and bioenergy solutions. These projects reduce reliance on fossil fuels and promote clean energy in Fiji.</p>
        </a>

    </section>
@endsection