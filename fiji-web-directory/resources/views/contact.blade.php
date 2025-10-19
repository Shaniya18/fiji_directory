@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/contact.css') }}">
@endsection

@section('title', 'Contact Us - Fiji Web Directory')

@section('content')
    <div id="contactpage-content-box">
        <h2>Have a question? We would love to hear it from you.</h2>
        <hr>
        
        @if(session('success'))
            <div style="background: #4CAF50; color: white; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: #f44336; color: white; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            
            <label for="name">Name:</label> <br>
            <input type="text" name="name" id="name" placeholder="Please enter your name" 
                   class="contactuspage-inputboxes" value="{{ old('name') }}" required>
            <br><br>

            <label for="email">Email:</label> <br>
            <input type="email" name="email" id="email" placeholder="Please enter your email" 
                   class="contactuspage-inputboxes" value="{{ old('email') }}" required>
            <br><br>

            <label for="message">Message:</label> <br>
            <textarea name="message" id="message" cols="30" rows="10" style="resize: none;" 
                      placeholder="Please enter your message" required>{{ old('message') }}</textarea>
            <br><br>

            <button type="submit" class="contactusform-btns">Submit</button>
            <input type="reset" class="contactusform-btns" value="Reset">
        </form>
    </div>
@endsection