@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/langstyle.css') }}">
@endsection

@section('title', 'Business - Fiji Web Directory')

@section('content')
    <section class="departments">

        <a href="{{ route('categories.listings', ['category' => 'business', 'subcategory' => 'retail-wholesale']) }}" class="department">
            <h3>Retail & Wholesale</h3>
            <p>Shops, supermarkets, and distributors providing consumer goods and daily essentials. These businesses connect suppliers to households and communities.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'business', 'subcategory' => 'manufacturing']) }}" class="department">
            <h3>Manufacturing</h3>
            <p>Factories and companies producing beverages, textiles, sugar, and other goods. Manufacturing plays a key role in Fiji's economy and exports.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'business', 'subcategory' => 'small-medium-enterprises']) }}" class="department">
            <h3>Small and Medium Enterprises</h3>
            <p>Locally owned businesses offering crafts, food products, tech solutions, and services. SMEs drive innovation, employment, and community-based economic growth.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'business', 'subcategory' => 'corporate-services']) }}" class="department">
            <h3>Corporate Services</h3>
            <p>Professional firms in accounting, banking, and consultancy that support business operations. They help organizations manage finances, compliance, and strategy.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'business', 'subcategory' => 'financial-services']) }}" class="department">
            <h3>Financial Services</h3>
            <p>Banks, funds, and insurance providers offering loans, savings, and investment solutions. These institutions ensure financial stability and security for individuals and businesses.</p>
        </a>

    </section>
@endsection