@extends('layouts.master')

@section('title', 'Contacts')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Contacts</h4>
        </div>
        <div class="card-body">
            <!-- رسالة النجاح -->
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <!-- البحث -->
            <form method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by email or message..." value="{{ request('search') }}">
                    <button class="btn btn-secondary" type="submit">Search</button>
                </div>
            </form>

            <!-- عرض النتائج -->
            @if ($contacts->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->user_id ?? 'N/A' }}</td>
                                <td>{{ $contact->contact_email }}</td>
                                <td>{{ Str::limit($contact->message, 50) }}</td>
                                <td>{{ $contact->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-info btn-sm">View</a>
                                    <form action="{{ route('admin.contacts.markAsRead', $contact->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PUT')
                                        @if(!$contact->is_read)
                                            <button type="submit" class="btn btn-success btn-sm">Read</button>
                                        @else
                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Read</button>
                                        @endif
                                    </form>
                                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

  

                <div class="d-flex justify-content-center">
                    {{ $contacts->links('pagination::bootstrap-4') }}
                </div>
        
                @else
                <div class="alert alert-warning">No results found.</div>
            @endif

        </div>
    </div>
</div>
@endsection
