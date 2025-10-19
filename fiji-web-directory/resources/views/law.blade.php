@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/langstyle.css') }}">
@endsection

@section('title', 'Law & Justice - Fiji Web Directory')

@section('content')
    <section class="departments">

        <a href="{{ route('categories.listings', ['category' => 'law', 'subcategory' => 'courts-tribunals']) }}" class="department">
            <h3>Courts & Tribunals</h3>
            <p>Judicial institutions that administer justice and resolve legal disputes. They uphold the rule of law across Fiji's legal system.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'law', 'subcategory' => 'police-law-enforcement']) }}" class="department">
            <h3>Police & Law Enforcement</h3>
            <p>Security forces maintaining public order, investigating crimes, and ensuring community safety. They serve as the frontline of law enforcement in Fiji.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'law', 'subcategory' => 'legal-aid-services']) }}" class="department">
            <h3>Legal Aid Services</h3>
            <p>Organizations providing free or affordable legal representation to those in need. They ensure access to justice for all members of society.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'law', 'subcategory' => 'correctional-facilities']) }}" class="department">
            <h3>Correctional Facilities</h3>
            <p>Prisons and rehabilitation centers focused on correction and reintegration. They manage offender custody and support reformation programs.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'law', 'subcategory' => 'human-rights-organizations']) }}" class="department">
            <h3>Human Rights Organizations</h3>
            <p>Advocacy groups promoting equality, justice, and human dignity. They monitor rights violations and support vulnerable populations across Fiji.</p>
        </a>

    </section>
@endsection