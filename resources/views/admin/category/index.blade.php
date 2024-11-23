@extends('layouts.master')
@section('title', 'Categories')
@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Categories</h4>
            <a href="{{ route('admin.add-category') }}" class="btn btn-primary btn-sm">Add Category</a>
        </div>
        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <!-- شريط البحث -->
            <form method="GET" action="{{ route('admin.categories.index') }}">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search Categories" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-secondary">Search</button>
                </div>
            </form>

            <!-- إذا كانت نتيجة البحث فارغة -->
            @if(count($categories) == 0)
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
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.edit-category', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('admin.soft-delete-category', $category->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- إضافة الباجنيشن مع التنسيق في المنتصف -->
                <nav>
                    <ul class="pagination justify-content-center" style="display: flex; justify-content: center; align-items: center;">
                        <!-- بريفيوس -->
                        <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $categories->previousPageUrl() }}" aria-label="Previous">
                                ‹
                            </a>
                        </li>

                        <!-- أرقام الصفحات -->
                        @foreach(range(1, $categories->lastPage()) as $i)
                            <li class="page-item {{ $categories->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                            </li>
                        @endforeach

                        <!-- نكس -->
                        <li class="page-item {{ $categories->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Next">
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
