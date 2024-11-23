@extends('layouts.master')

@section('title', 'Contact Details')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Contact Details</h4>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm">Back</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">User ID</label>
                <p class="form-control">{{ $contact->user_id ?? 'N/A' }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <p class="form-control">{{ $contact->contact_email }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <p class="form-control">{{ $contact->message }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Created At</label>
                <p class="form-control">{{ $contact->created_at }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
