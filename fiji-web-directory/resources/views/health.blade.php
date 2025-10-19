@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/langstyle.css') }}">
@endsection

@section('title', 'Health - Fiji Web Directory')

@section('content')
    <section class="departments">

        <a href="{{ route('categories.listings', ['category' => 'health', 'subcategory' => 'hospitals']) }}" class="department">
            <h3>Hospitals</h3>
            <p>Major public and private hospitals across Fiji that provide inpatient, outpatient, and emergency services. They serve as primary health facilities for communities nationwide.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'health', 'subcategory' => 'clinics']) }}" class="department">
            <h3>Clinics</h3>
            <p>Smaller health centers and private practices offering general medical care and specialized treatments. Clinics provide accessible and often faster healthcare options.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'health', 'subcategory' => 'public-health-services']) }}" class="department">
            <h3>Public Health Services</h3>
            <p>Government and community health programs focusing on prevention, immunization, and disease control. These services aim to improve overall public health and wellbeing.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'health', 'subcategory' => 'mental-health-services']) }}" class="department">
            <h3>Mental Health Services</h3>
            <p>Organizations and clinics supporting mental wellness, psychiatric care, and counseling. They address growing awareness and treatment needs for mental health in Fiji.</p>
        </a>

    </section>
@endsection