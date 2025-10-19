@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/form.css') }}">
@endsection

@section('title', 'Submit Listing - Fiji Web Directory')

@section('content')
    <div id="submitlisting-container">
        <h2>Fill in the required details below:</h2>
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
        
        <form action="{{ route('submit') }}" method="POST" id="submit-listing-form">
            @csrf
            <br>
            <label for="business_name">Name:</label>
            <br>
            <input type="text" id="business_name" name="business_name" 
                   placeholder="Enter the name of the website / organization" 
                   value="{{ old('business_name') }}" required>
            <br><br>

            <label for="website_url">URL:</label>
            <br>
            <input type="url" id="website_url" name="website_url" 
                   placeholder="Enter the url of the website / organization" 
                   value="{{ old('website_url') }}">
            <br><br>

            <label for="description">Description:</label>
            <br>
            <textarea name="description" id="description" cols="30" rows="10" 
                      style="resize: none;" placeholder="Enter the organization / website Information" 
                      required>{{ old('description') }}</textarea>
            <br><br>

            <label for="contact_email">Email:</label>
            <br>
            <input type="email" id="contact_email" name="contact_email" 
                   placeholder="Enter the email address" value="{{ old('contact_email') }}" required>
            <br><br>

            <label for="phone_number">Phone:</label>
            <br>
            <input type="text" id="phone_number" name="phone_number" 
                   placeholder="Enter the phone number" value="{{ old('phone_number') }}" required>
            <br><br>

            <label for="category_id">Category:</label>
<br>
<select name="category_id" id="category_id" required>
    <option value="">Select a specific category</option>
    @foreach($categories as $category)
        <optgroup label="{{ $category->name }}">
            @foreach($category->children as $subcategory)
                <option value="{{ $subcategory->id }}" {{ old('category_id') == $subcategory->id ? 'selected' : '' }}>
                    {{ $subcategory->name }}
                </option>
            @endforeach
        </optgroup>
    @endforeach
</select>
            <br><br>

            <label for="region">Region:</label>
            <br>
            <select name="region" id="region">
                <option value="">Select a region</option>
                <option value="Viti Levu" {{ old('region') == 'Viti Levu' ? 'selected' : '' }}>Viti Levu</option>
                <option value="Vanua Levu" {{ old('region') == 'Vanua Levu' ? 'selected' : '' }}>Vanua Levu</option>
                <option value="Other Islands" {{ old('region') == 'Other Islands' ? 'selected' : '' }}>Other Islands</option>
            </select>
            <br><br>

            <label for="tags">Tags:</label>
            <br>
            <input type="text" id="tags" name="tags" placeholder="Enter tags (comma separated)" 
                   value="{{ old('tags') }}">
            <br><br>

            <label>
                <input type="checkbox" id="captcha-checkbox" required>
                I am not a robot
            </label>
            <br><br>

            <button type="submit" class="submitwebsite-btns">Submit</button>
            <input type="reset" value="Reset" class="submitwebsite-btns">
        </form>
    </div>
@endsection