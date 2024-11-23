@extends('layouts.master')

@section('title', 'Price Ranges')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Price Ranges</h4>
            <a href="{{ route('admin.price_range.create') }}" class="btn btn-primary btn-sm">Add Price Range</a>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                    <button class="btn btn-secondary" type="submit">Search</button>
                </div>
            </form>

            @if ($ranges->count() > 0)
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
                        @foreach ($ranges as $range)
                            <tr>
                                <td>{{ $range->id }}</td>
                                <td>{{ $range->name }}</td>
                                <td>{{ $range->description }}</td>
                                <td>{{ $range->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.price_range.edit', $range->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.price_range.destroy', $range->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this price range?');">
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
                    {{ $ranges->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div class="alert alert-warning">No results found.</div>
            @endif
        </div>
    </div>
</div>
@endsection
