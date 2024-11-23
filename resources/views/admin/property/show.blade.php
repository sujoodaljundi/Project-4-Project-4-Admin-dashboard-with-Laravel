@extends('layouts.master')

@section('title', 'Property Details')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center text-dark mb-4" style="font-size: 2rem; background-color: #f2a900; padding: 15px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">Property Details: {{ $property->name }}</h1>
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <img src="{{ asset('uploads/'.$property->cover) }}" alt="Property Image" class="img-fluid rounded shadow-lg" style="max-width: 20%; height: auto; border-radius: 10px;">
            </div>
        </div>
        <!-- عرض تفاصيل العقار -->
        <div class="row mb-4">
            <div class="col-md-12">
                <table class="table table-bordered shadow-sm">
                    <thead class="thead-light" style="background-color: #f2a900;">
                        <tr>
                            <td colspan="2" class="text-center text-white" style="font-size: 1.5rem; padding: 12px; border-radius: 5px;">Property Info</td>
                        </tr>
                    </thead>

                    <tbody style="background-color: #f7f7f7; color: #333;">
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td>{{ $property->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Category:</strong></td>
                            <td>{{ $property->category->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Type:</strong></td>
                            <td>{{ $property->type }}</td>
                        </tr>
                        <tr>
                            <td><strong>Address:</strong></td>
                            <td>{{ $property->address }}</td>
                        </tr>
                        <tr>
                            <td><strong>Description:</strong></td>
                            <td>{{ $property->description }}</td>
                        </tr>
                        <tr>
                            <td><strong>Summary:</strong></td>
                            <td>{{ $property->summary }}</td>
                        </tr>
                        <tr>
                            <td><strong>Price:</strong></td>
                            <td>${{ number_format($property->price, 2) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>{{ $property->status }}</td>
                        </tr>
                        <tr>
                            <td><strong>Latitude:</strong></td>
                            <td>{{ $property->latitude }}</td>
                        </tr>
                        <tr>
                            <td><strong>Longitude:</strong></td>
                            <td>{{ $property->longitude }}</td>
                        </tr>
                        <tr>
                            <td><strong>Created At:</strong></td>
                            <td>{{ $property->created_at }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated At:</strong></td>
                            <td>{{ $property->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- عرض Property Condition -->
        @if($property->propertyCondition)
        <div class="row mb-4">
            <div class="col-md-12">
                <table class="table table-bordered shadow-sm">
                    <thead class="thead-light" style="background-color: #f2a900;">
                        <tr>
                            <td colspan="2" class="text-center text-white" style="font-size: 1.5rem; padding: 12px; border-radius: 5px;">Property Condition</td>
                        </tr>
                    </thead>
                    <tbody style="background-color: #f7f7f7; color: #333;">
                        <tr>
                            <td><strong>Condition Name:</strong></td>
                            <td>{{ $property->propertyCondition->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Description:</strong></td>
                            <td>{{ $property->propertyCondition->description }}</td>
                        </tr>
                        <tr>
                            <td><strong>Created At:</strong></td>
                            <td>{{ $property->propertyCondition->created_at }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated At:</strong></td>
                            <td>{{ $property->propertyCondition->updated_at }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <a href="{{ route('admin.property_condition.edit', $property->propertyCondition->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.property_condition.destroy', $property->propertyCondition->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this property condition?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="row mb-4">
            <div class="col-md-12">
                <p class="text-muted text-center">No property condition available for this property.</p>
            </div>
        </div>
        @endif

        <!-- عرض Property Status -->
        @if($property->propertyStatus)
        <div class="row mb-4">
            <div class="col-md-12">
                <table class="table table-bordered shadow-sm">
                    <thead class="thead-light" style="background-color: #f2a900;">
                        <tr>
                            <td colspan="2" class="text-center text-white" style="font-size: 1.5rem; padding: 12px; border-radius: 5px;">Property Status</td>
                        </tr>
                    </thead>
                    <tbody style="background-color: #f7f7f7; color: #333;">
                        <tr>
                            <td><strong>Status Name:</strong></td>
                            <td>{{ $property->propertyStatus->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Description:</strong></td>
                            <td>{{ $property->propertyStatus->description }}</td>
                        </tr>
                        <tr>
                            <td><strong>Created At:</strong></td>
                            <td>{{ $property->propertyStatus->created_at }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated At:</strong></td>
                            <td>{{ $property->propertyStatus->updated_at }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <a href="{{ route('admin.property_status.edit', $property->propertyStatus->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.property_status.destroy', $property->propertyStatus->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this property status?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="row mb-4">
            <div class="col-md-12">
                <p class="text-muted text-center">No property status available for this property.</p>
            </div>
        </div>
        @endif

        <!-- عرض Price Range -->
        @if($property->priceRange)
        <div class="row mb-4">
            <div class="col-md-12">
                <table class="table table-bordered shadow-sm">
                    <thead class="thead-light" style="background-color: #f2a900;">
                        <tr>
                            <td colspan="2" class="text-center text-white" style="font-size: 1.5rem; padding: 12px; border-radius: 5px;">Price Range</td>
                        </tr>
                    </thead>
                    <tbody style="background-color: #f7f7f7; color: #333;">
                        <tr>
                            <td><strong>Range Name:</strong></td>
                            <td>{{ $property->priceRange->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Description:</strong></td>
                            <td>{{ $property->priceRange->description }}</td>
                        </tr>
                        <tr>
                            <td><strong>Created At:</strong></td>
                            <td>{{ $property->priceRange->created_at }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <a href="{{ route('admin.price_range.edit', $property->priceRange->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.price_range.destroy', $property->priceRange->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this price range?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="row mb-4">
            <div class="col-md-12">
                <p class="text-muted text-center">No price range available for this property.</p>
            </div>
        </div>
        @endif
    </div>
@endsection
