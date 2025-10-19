@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/approve.css') }}">
@endsection

@section('title', 'Contact Messages - Admin')

@section('content')
    <div class="container">
        <section id="approve-delete-section">
            <h2>Contact Messages</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ Str::limit($contact->message, 50) }}</td>
                            <td>{{ $contact->created_at->format('M d, Y') }}</td>
                            <td>
                                <form action="{{ route('admin.contacts.delete', $contact->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn delete-btn" onclick="return confirm('Delete this message?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px;">No contact messages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
@endsection