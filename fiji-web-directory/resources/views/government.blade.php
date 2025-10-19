@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/langstyle.css') }}">
@endsection

@section('title', 'Government - Fiji Web Directory')

@section('content')
    <section class="departments">

        <a href="{{ route('categories.listings', ['category' => 'government', 'subcategory' => 'national-government']) }}" class="department">
            <h3>National Government</h3>
            <p>National-level ministries, commissions, and agencies responsible for policy-making, governance, and administration across Fiji. These organizations shape national development, finance, education, health, and trade.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'government', 'subcategory' => 'local-government-authorities']) }}" class="department">
            <h3>Local Government Authorities</h3>
            <p>Town and city councils that oversee urban planning, public works, and local services in Fiji's municipalities. They play a vital role in community development and service delivery at the grassroots level.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'government', 'subcategory' => 'ministries-departments']) }}" class="department">
            <h3>Ministries & Departments</h3>
            <p>Specialized government departments tasked with managing specific sectors such as immigration, environment, and agriculture. They implement national policies and ensure compliance with laws and regulations.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'government', 'subcategory' => 'public-services']) }}" class="department">
            <h3>Public Services</h3>
            <p>Essential state-run services like roads, power, water, and policing that support daily life across Fiji. These organizations maintain infrastructure, utilities, and public safety.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'government', 'subcategory' => 'regulatory-bodies']) }}" class="department">
            <h3>Regulatory Bodies</h3>
            <p>Independent or semi-autonomous institutions that regulate finance, trade, broadcasting, and consumer protection. They safeguard fair practices and accountability across Fiji's economy and society.</p>
        </a>

    </section>
@endsection