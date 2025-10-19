@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/terms.css') }}">
@endsection

@section('title', 'Terms of Use - Fiji Web Directory')

@section('content')
    <div id="page-banner-container"
        style="background-image: url('{{ asset('images/about-page-banner.gif') }}'); background-size: cover;">
        <div id="page-banner-box" class="aboutus-bannerbox">
            <h1 id="aboutus-banner-title">Terms of Use</h1>
            <hr id="aboutus-banner-separator">
        </div>
    </div>

    <div id="termsofuse-content-container">
        <h2 id="termsofuse-content-title">Fiji Web Directory – Terms of Use</h2>

        <h3 class="termsofuse-content-subtitles">1. Acceptance of Terms</h3>
        <span class="termsofuse-content-subtexts">By accessing or using the Fiji Web Directory ("the Directory"), you agree to be bound by these Terms of Use. If you do not agree, please do not use the Directory.</span> <br><br>

        <h3 class="termsofuse-content-subtitles">2. Purpose of the Directory</h3>
        <span class="termsofuse-content-subtexts">The Directory is an online platform designed to index and organize websites, businesses, organizations, and services relevant to Fiji. It is provided for informational and navigational purposes only.</span> <br><br>

        <!-- Rest of terms content from your original HTML -->
        
    </div>
@endsection