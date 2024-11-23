@extends('layouts.master')

@section('title', 'Edit Price Range')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Edit Price Range</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.price_range.update', $range->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Price Range Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $range->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" required>{{ $range->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Price Range</button>
            </form>
        </div>
    </div>
</div>
@endsection
