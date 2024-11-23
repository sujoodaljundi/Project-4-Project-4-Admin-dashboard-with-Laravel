@extends('layouts.master')

@section('title', 'Property Conditions')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Property Conditions</h4>
            <a href="{{ route('admin.property_condition.create') }}" class="btn btn-primary btn-sm">Add Condition</a>
        </div>
        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form method="GET" action="{{ route('admin.property_condition.index') }}">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search Conditions" value="{{ request()->get('search') }}">
                    <button type="submit" class="btn btn-outline-secondary">Search</button>
                </div>
            </form>
            @if(count($conditions) == 0)
                <div class="alert alert-warning">
                    No results found.
                </div>
            @else
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
                    @foreach($conditions as $condition)
                        <tr>
                            <td>{{ $condition->id }}</td>
                            <td>{{ $condition->name }}</td>
                            <td>{{ $condition->description }}</td>
                            <td>{{ $condition->created_at }}</td> <!-- عرض القيمة -->

                            <td>
                                <a href="{{ route('admin.property_condition.edit', $condition->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.property_condition.destroy', $condition->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this property condition?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $conditions->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
