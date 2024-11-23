@extends('layouts.master')

@section('title', 'Edit Property Status')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Edit Property Status</h4>
            <a href="{{ route('admin.property_status.index') }}" class="btn btn-primary btn-sm float-end">Back</a>

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

            <!-- الفورم الخاص بتعديل حالة -->
            <form action="{{ route('admin.property_status.update', $status->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- اسم الحالة -->
                <div class="mb-3">
                    <label for="name" class="form-label">Status Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $status->name) }}" required>
                </div>

                <!-- وصف الحالة -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $status->description) }}</textarea>
                </div>

                <!-- زر الحفظ -->
                <button type="submit" class="btn btn-primary">Update Status</button>
            </form>
        </div>
    </div>
</div>
@endsection
