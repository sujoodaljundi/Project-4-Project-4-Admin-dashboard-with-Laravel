@extends('layouts.master')

@section('title', 'Edit Property')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Edit Property</h4>
            <a href="{{ route('admin.property.index') }}" class="btn btn-primary btn-sm">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.property.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- اسم العقار -->
                <div class="mb-3">
                    <label for="name" class="form-label">Property Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $property->name) }}" required>
                </div>

                <!-- نوع العقار -->
                <div class="mb-3">
                    <label for="type" class="form-label">Property Type</label>
                    <select name="type" class="form-control" required>
                        <option value="Apartment" {{ $property->type == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="House" {{ $property->type == 'House' ? 'selected' : '' }}>House</option>
                        <option value="Studio" {{ $property->type == 'Studio' ? 'selected' : '' }}>Studio</option>
                        <option value="Villa" {{ $property->type == 'Villa' ? 'selected' : '' }}>Villa</option>
                    </select>
                </div>

                <!-- السعر -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" name="price" class="form-control" value="{{ old('price', $property->price) }}" pattern="^\d*(\.\d{0,2})?$" placeholder="Enter price (e.g., 123.45)" required>
                    </div>
                </div>

                <!-- الصورة الرئيسية -->
                <!-- الصورة الرئيسية -->
                <div class="mb-3">
                    <label for="cover" class="form-label">Cover Image</label>
                    <input type="file" name="cover" class="form-control">
                    @if($property->cover)
                        <div class="mt-2">
                            <img src="{{ Storage::url($property->cover) }}" alt="Property Image" width="100">
                        </div>
                    @endif
                    @error('cover')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <!-- العنوان -->
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $property->address) }}" required>
                </div>

                <!-- الوصف -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" required>{{ old('description', $property->description) }}</textarea>
                </div>

                <!-- الفئة -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $property->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- حالة العقار -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Available" {{ $property->status == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Reserved" {{ $property->status == 'Reserved' ? 'selected' : '' }}>Reserved</option>
                        <option value="Unavailable" {{ $property->status == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>



                <!-- Summary -->
                <div class="mb-3">
                    <label for="summary" class="form-label">Summary</label>
                    <input type="text" name="summary" class="form-control" value="{{ old('summary', $property->summary) }}" required>
                </div>

                <!-- زر التحديث -->
                <button type="submit" class="btn btn-primary">Update Property</button>
            </form>
        </div>
    </div>
</div>

@endsection
