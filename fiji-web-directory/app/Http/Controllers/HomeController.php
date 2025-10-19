<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function contact()
    {
        return view('contact');
    }

    public function terms()
    {
        return view('terms');
    }

    public function search(Request $request)
    {
        return view('search');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->route('contact')->with('success', 
            'Thank you for contacting us! We will respond to your message shortly.');
    }
}