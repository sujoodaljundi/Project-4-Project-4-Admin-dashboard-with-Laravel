@extends('layouts.master')

@section('title', 'Edit Property Condition')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Edit Property Condition</h4>
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

            <!-- الفورم الخاص بتعديل الشرط -->
            <form action="{{ route('admin.property_condition.update', $condition->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- اسم الشرط -->
                <div class="mb-3">
                    <label for="name" class="form-label">Condition Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $condition->name) }}" required>
                </div>

                <!-- وصف الشرط -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $condition->description) }}</textarea>
                </div>

                <!-- زر التحديث -->
                <button type="submit" class="btn btn-primary">Update Condition</button>
            </form>
        </div>
    </div>
</div>
@endsection
