@extends('layouts.master')

@section('title', 'Add Property Condition')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Add Property Condition</h4>
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

            <!-- الفورم الخاص بإضافة شرط جديد -->
            <form action="{{ route('admin.property_condition.store') }}" method="POST">
                @csrf

                <!-- اسم الشرط -->
                <div class="mb-3">
                    <label for="name" class="form-label">Condition Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <!-- وصف الشرط -->


                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>

                </div>
                


                <!-- زر الإضافة -->
                <button type="submit" class="btn btn-primary">Add Condition</button>
            </form>
        </div>
    </div>
</div>
@endsection
