@extends('layouts.master')

@section('title', 'Property Statuses')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Property Statuses</h4>
            <a href="{{ route('admin.property_status.create') }}" class="btn btn-primary btn-sm">Add Status</a>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <!-- البحث -->
            <form method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                    <button class="btn btn-secondary" type="submit">Search</button>
                </div>
            </form>

            @if ($statuses->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statuses as $status)
                            <tr>
                                <td>{{ $status->id }}</td>
                                <td>{{ $status->name }}</td>
                                <td>{{ $status->description }}</td>
                                <td>{{ $status->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.property_status.edit', $status->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.property_status.destroy', $status->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this property status?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $statuses->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div class="alert alert-warning">No results found.</div>
            @endif
        </div>
    </div>
</div>
@endsection
