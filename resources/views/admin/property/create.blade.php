@extends('layouts.master')

@section('title', 'Add Property')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Add Property</h4>
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

            <!-- الفورم الخاص بإضافة العقار -->
            <form action="{{ route('admin.property.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- اسم العقار -->
                <div class="mb-3">
                    <label for="name" class="form-label">Property Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <!-- نوع العقار -->
                <div class="mb-3">
                    <label for="type" class="form-label">Property Type</label>
                    <select name="type" class="form-control" required>
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                        <option value="Studio">Studio</option>
                        <option value="Villa">Villa</option>
                    </select>
                </div>

                <!-- السعر -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <!-- استخدمنا input type="text" بدلاً من number لمنع ظهور الأسهم -->
                        <input type="text" name="price" class="form-control" pattern="^\d*(\.\d{0,2})?$" placeholder="Enter price (e.g., 123.45)" required>
                    </div>
                </div>

                <!-- الصورة الرئيسية -->
                <div class="mb-3">
                    <label for="cover" class="form-label">Cover Image</label>
                    <input type="file" name="cover" class="form-control" required>
                </div>

                <!-- العنوان -->
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" required>
                </div>

                <!-- الوصف -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>

                <!-- الفئة -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- حالة العقار -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Available">Available</option>
                        <option value="Reserved">Reserved</option>
                        <option value="Unavailable">Unavailable</option>
                    </select>
                </div>

                <!-- Summary -->
                <div class="mb-3">
                    <label for="summary" class="form-label">Summary</label>
                    <input type="text" name="summary" class="form-control" required>
                </div>

                <!-- زر الإرسال -->
                <button type="submit" class="btn btn-primary">Add Property</button>
            </form>
        </div>
    </div>
</div>

@endsection
