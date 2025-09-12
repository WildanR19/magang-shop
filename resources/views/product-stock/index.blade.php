@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Product Management</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Post Create/Edit Form -->
        <div class="card mb-4">
            <div class="card-header">Add / Edit Product</div>
            <div class="card-body">
                <form action="{{ route('product-stock.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <select name="product_id" id="product_id" class="form-select">
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <select name="change_type" id="type" class="form-select">
                            <option value="">Select Type</option>
                            <option value="in">Stock In</option>
                            <option value="out">Stock Out</option>
                        </select>
                    </div>
                    <div>
                        <label for="quantity_changed" class="form-label">Quantity Changed</label>
                        <input type="number" name="quantity_changed" class="form-control" value="{{ $log->quantity_changed ?? old('quantity_changed') }}"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                    @if(isset($log))
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Post Table -->
        <div class="card">
            <div class="card-header">Post List</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $index => $log)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $log->product?->name }}</td>
                                <td>{{ $log->change_type }}</td>
                                <td>{{ $log->quantity_changed }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $logs->links() }}
            </div>
        </div>
    </div>
@endsection