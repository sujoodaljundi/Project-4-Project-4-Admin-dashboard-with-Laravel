@extends('layouts.master')
@section('title', 'Properties')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Properties</h4>
            <a href="{{ route('admin.property.create') }}" class="btn btn-primary btn-sm">Add Property</a>
        </div>
        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <!-- شريط البحث مع زر بحث -->
            <form action="{{ route('admin.property.index') }}" method="GET" class="mb-3">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, address or summary" value="{{ request()->get('search') }}">
                    <button type="submit" class="btn btn-outline-secondary">Search</button>
                </div>
            </form>
            @if(count($properties) == 0)
                <div class="alert alert-warning">
                    No results found.
                </div>
            @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Summary</th>
                        <th>Price</th>
                        <th>Cover</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($properties as $property)
                        <tr>
                            <td>{{ $property->id }}</td>
                            <td>{{ $property->user_id }}</td>
                            <td>{{ $property->name }}</td>
                            <td>{{ $property->summary }}</td>
                            <td>{{ $property->price }}</td>
                            <td>
                                <img src="{{ asset('uploads/'.$property->cover) }}" alt="Cover Image" width="50">
                            </td>
                            <td>
                                <a href="{{ route('admin.property.edit', $property->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('admin.property.show', $property->id) }}" class="btn btn-info btn-sm">View</a>
                                <form action="{{ route('admin.property.destroy', $property->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- شريط الباجنيشن مع نكس و بريفيوس -->
            <nav >
                <ul class="pagination" style="display: flex; justify-content: center; align-items: center;">
                    <!-- بريفيوس -->
                    <li class="page-item {{ $properties->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $properties->previousPageUrl() }}" aria-label="Previous">
                            ‹
                        </a>
                    </li>

                    <!-- أرقام الصفحات -->
                    @for ($i = 1; $i <= $properties->lastPage(); $i++)
                        <li class="page-item {{ $i == $properties->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $properties->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- نكس -->
                    <li class="page-item {{ $properties->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $properties->nextPageUrl() }}" aria-label="Next">
                            ›
                        </a>
                    </li>
                </ul>
            </nav>
            @endif
        </div>
    </div>
</div>

@endsection
