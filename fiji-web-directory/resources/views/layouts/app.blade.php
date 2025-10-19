<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Fiji Web Directory')</title>
    <link rel="stylesheet" href="{{ asset('styles/styles.css') }}">
    @yield('styles')
</head>
<body>
    <main>
        <div class="head">
            <a class="title" href="{{ route('home') }}">
                <h1>Fiji Web Directory</h1>
            </a>
        </div>

        <nav>
            <div class="topnav">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('categories') }}" class="{{ request()->routeIs('categories*') ? 'active' : '' }}">Categories</a>
                <a href="{{ route('search') }}" class="{{ request()->routeIs('search') ? 'active' : '' }}">Search</a>
                
                @auth
                    @if(auth()->user()->is_admin)
                        <a class="right" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                    @endif
                    <a class="right" href="{{ route('submit') }}">Submit Listing</a>
                    <a class="right" href="{{ route('logout') }}">Logout ({{ auth()->user()->username }})</a>
                @else
                    <a class="right" href="{{ route('submit') }}">Submit Listing</a>
                    <a class="right {{ request()->routeIs('signin') || request()->routeIs('create') ? 'active' : '' }}" href="{{ route('signin') }}">Sign-In</a>
                @endauth
            </div>
        </nav>

        @if(session('success'))
            <div style="background: #4caf50; color: white; padding: 15px; margin: 20px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #f44336; color: white; padding: 15px; margin: 20px; border-radius: 5px;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <p id="footer-left">
            &copy; <a href="{{ route('home') }}">FijiWebDirectory</a>. All rights reserved.
        </p>
        <p id="footer-right">
            <a href="{{ route('contact') }}" class="footer-right-items">Contact Us</a> |
            <a href="{{ route('terms') }}" class="footer-right-items">Terms Of Use</a>
        </p>
    </footer>

    @yield('scripts')
</body>
</html>