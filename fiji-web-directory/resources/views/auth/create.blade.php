@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/table.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/create.css') }}">
@endsection

@section('title', 'Create Account - Fiji Web Directory')

@section('content')
    <div id="register-content-container">
        <form action="{{ route('create') }}" method="POST">
            @csrf
            
            <h1>Create an Account</h1>
            <hr>
            
            @if($errors->any())
                <div style="color: red; padding: 10px; margin-bottom: 15px; background: #ffebee; border-radius: 5px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <label for="username" class="registerform-labels">Username:</label><br>
            <input type="text" id="username" name="username" placeholder="Choose a username" 
                   class="registerform-input" value="{{ old('username') }}" required><br><br>

            <label for="email" class="registerform-labels">Email Address:</label><br>
            <input type="email" id="email" name="email" placeholder="Enter your email" 
                   class="registerform-input" value="{{ old('email') }}" required><br><br>

            <label for="password" class="registerform-labels">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Create a password" 
                   class="registerform-input" required><br><br>

            <label for="password_confirmation" class="registerform-labels">Confirm Password:</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" 
                   placeholder="Re-enter password" class="registerform-input" required><br><br>

            <button type="submit" class="registerform-btn">Create Account</button>
            <input type="reset" class="registerform-btn" value="Reset" style="margin-left: 5px;"><br><br>

            <span class="registerform-login-link">
                Already have an account? <a href="{{ route('signin') }}">Sign in here</a>.
            </span>
        </form>
    </div>
@endsection