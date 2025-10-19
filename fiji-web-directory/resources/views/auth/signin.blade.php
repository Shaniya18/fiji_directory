@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/login.css') }}">
@endsection

@section('title', 'Sign In - Fiji Web Directory')

@section('content')
    <div id="login-content-container">
        <form action="{{ route('signin') }}" method="POST">
            @csrf
            
            <h1>Welcome, enter the login information below:</h1>
            <hr>
            
            @if($errors->any())
                <div style="color: red; padding: 10px; margin-bottom: 15px; background: #ffebee; border-radius: 5px;">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <label for="username" class="loginform-labels">Username:</label>
            <br>
            <input type="text" placeholder="Enter the username" 
                   class="loginform-inputboxes" name="username" id="username" 
                   value="{{ old('username') }}" required>
            <br><br>

            <label for="password" class="loginform-labels">Password:</label>
            <br>
            <input type="password" placeholder="Enter the password" 
                   class="loginform-inputboxes" name="password" id="password" required>
            <br><br>

            <button type="submit" class="loginform-btns">Sign-In</button>
            <input type="reset" class="loginform-btns" value="Reset" style="margin-left: 5px;">
            <br><br>
            
            <span id="loginform-forgotpassword-text">
                Forgot your password? Click here to 
                <a href="{{ route('home') }}" id="loginform-reset-text">reset the password.</a>
            </span>
            <br>
            <span id="loginform-forgotpassword-text">
                Don't have an account? Click here to 
                <a href="{{ route('create') }}" id="loginform-reset-text">create a new account.</a>
            </span>
        </form>
    </div>
@endsection