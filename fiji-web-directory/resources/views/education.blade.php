@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/langstyle.css') }}">
@endsection

@section('title', 'Education - Fiji Web Directory')

@section('content')
    <section class="departments">

        <a href="{{ route('categories.listings', ['category' => 'education', 'subcategory' => 'primary-schools']) }}" class="department">
            <h3>Primary Schools</h3>
            <p>Foundational education institutions for young learners across Fiji. They provide basic literacy, numeracy, and life skills essential for future learning.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'education', 'subcategory' => 'secondary-schools']) }}" class="department">
            <h3>Secondary Schools</h3>
            <p>High schools and colleges offering academic and vocational programs for teenagers. These institutions prepare students for tertiary education, training, or the workforce.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'education', 'subcategory' => 'higher-education']) }}" class="department">
            <h3>Higher Education</h3>
            <p>Universities and colleges that provide undergraduate and postgraduate degree programs. They serve as Fiji's hubs for advanced learning, research, and professional training.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'education', 'subcategory' => 'training-institutes']) }}" class="department">
            <h3>Training Institutes</h3>
            <p>Specialized centers offering vocational, technical, and professional skills development. These institutes equip learners with job-ready training for various industries.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'education', 'subcategory' => 'education-ngos']) }}" class="department">
            <h3>Education NGOs</h3>
            <p>Non-government organizations that promote education access, advocacy, and support services. They often focus on children, women, and disadvantaged communities.</p>
        </a>
    </section>
@endsection