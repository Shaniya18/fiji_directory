@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/langstyle.css') }}">
@endsection

@section('title', 'Media - Fiji Web Directory')

@section('content')
    <section class="departments">

        <a href="{{ route('categories.listings', ['category' => 'media', 'subcategory' => 'television-stations']) }}" class="department">
            <h3>Television Stations</h3>
            <p>Broadcasters delivering news, entertainment, and cultural programming across Fiji. They reach audiences nationwide with visual media.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'media', 'subcategory' => 'radio-stations']) }}" class="department">
            <h3>Radio Stations</h3>
            <p>FM and AM channels offering music, talk shows, and community updates. Radio remains one of Fiji's most accessible and popular media forms.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'media', 'subcategory' => 'newspapers-magazines']) }}" class="department">
            <h3>Newspapers & Magazines</h3>
            <p>Print and digital publications covering news, features, and opinions. They play a vital role in journalism and information-sharing.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'media', 'subcategory' => 'online-news-portals']) }}" class="department">
            <h3>Online News Portals</h3>
            <p>Web-based platforms offering up-to-date coverage of national and regional events. These portals are accessible worldwide and cater to Fiji's digital audience.</p>
        </a>

        <a href="{{ route('categories.listings', ['category' => 'media', 'subcategory' => 'social-media-platforms']) }}" class="department">
            <h3>Social Media Platforms</h3>
            <p>Communities and influencer groups active on global platforms like Facebook, TikTok, and LinkedIn. They shape online conversations, trends, and networking in Fiji.</p>
        </a>

    </section>
@endsection