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
                <form
                    action="{{ isset($productCategory) ? route('products.update', $productCategory->id) : route('product-categories.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($productCategory))
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ $productCategory->name ?? old('name') }}">
                    </div>
                    <button type="submit"
                        class="btn btn-primary">{{ isset($productCategory) ? 'Update' : 'Create' }}</button>
                    @if(isset($productCategory))
                        <a href="{{ route('product-categories.index') }}" class="btn btn-secondary">Cancel</a>
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
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <a href="{{ route('product-categories.edit', $product->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('product-categories.destroy', $product->id) }}" method="POST"
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

                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection