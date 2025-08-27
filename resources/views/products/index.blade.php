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
                <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($product))
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name ?? old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5"
                            required>{{ $product->description ?? old(key: 'description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" value="{{ $product->price ?? old('price') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{ $product->stock ?? old('stock') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ (isset($product) && $product->category_id == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" value="{{ $product->image ?? old('image') }}"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Create' }}</button>
                    @if(isset($product))
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
                            <th>Category</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="img-thumbnail" width="100">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection