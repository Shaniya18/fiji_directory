@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/approve.css') }}">
@endsection

@section('title', 'Review Submissions - Admin')

@section('content')
    <div class="container">
        <section id="approve-delete-section">
            <h2>Review Pending Submissions</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Business Name</th>
                        <th>Category</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($submissions as $submission)
                        <tr>
                            <td>{{ $submission->id }}</td>
                            <td>{{ $submission->business_name }}</td>
                            <td>{{ $submission->category->name }}</td>
                            <td>{{ $submission->contact_email }}</td>
                            <td class="status-{{ $submission->status }}">{{ ucfirst($submission->status) }}</td>
                            <td>{{ $submission->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($submission->status === 'pending')
                                    <form action="{{ route('admin.submissions.approve', $submission->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn approve-btn">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.submissions.reject', $submission->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn delete-btn" onclick="return confirm('Reject this submission?')">Reject</button>
                                    </form>
                                @else
                                    <span style="color: #999;">{{ ucfirst($submission->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 30px;">No submissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
@endsection