@extends('layouts.master')
@section('title', 'Users')
@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Users List
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-end">Add User</a>
            </h4>
        </div>
        <div class="card-body">
            <!-- إضافة نموذج البحث -->
            <form method="GET" action="{{ route('users.index') }}">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search Users" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-secondary">Search</button>
                </div>
            </form>

            <!-- عرض رسالة عند عدم وجود نتائج للبحث -->
            @if(count($users) == 0)
                <div class="alert alert-warning">
                    No results found.
                </div>
            @endif

            <!-- جدول عرض المستخدمين -->
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Deleted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->country }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                <a href="{{ route('users.toggleDelete', $user->id) }}" class="btn {{ $user->deleted == 1 ? 'btn-success' : 'btn-danger' }}">
                                    {{ $user->deleted == 1 ? 'Reactivate' : 'Deactivate' }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- إضافة الباجنيشن مع التنسيق في المنتصف -->
            <nav>
                <ul class="pagination justify-content-center" style="display: flex; justify-content: center; align-items: center;">
                    <!-- بريفيوس -->
                    <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                            ‹
                        </a>
                    </li>

                    <!-- أرقام الصفحات -->
                    @foreach(range(1, $users->lastPage()) as $i)
                        <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                        </li>
                    @endforeach

                    <!-- نكس -->
                    <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                            ›
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
