@extends('layouts.master')

@section('title', 'Property Condition Details')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>Property Condition Details</h4>
            <a href="{{ route('admin.property-condition.show', $condition->id) }}" class="btn btn-secondary btn-sm">Back to Property Condition</a>
        </div>
        <div class="card-body">
            <h5>Condition Name: {{ $condition->name }}</h5>
            <p><strong>Description:</strong> {{ $condition->description }}</p>
            <p><strong>Created At:</strong> {{ $condition->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $condition->updated_at }}</p>
        </div>
    </div>
</div>
@endsection
