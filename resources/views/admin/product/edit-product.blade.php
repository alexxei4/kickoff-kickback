@extends('layouts.adminlayout')

@section('title', 'Edit Product')

@section('content')

    <h1>Edit Product</h1>

    <div class="card">
        <div class="card-body">
        <form action="{{ route('update.product', $product->id) }} " method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-6 mb-3">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" value="{{ $product->slug }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cost">Cost</label>
                    <input type="number" step="any" class="form-control" name="cost" value="{{ $product->cost }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description">Description</label>
                    <textarea rows="3" class="form-control" name="description">{{ $product->description }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" name="brand" value="{{ $product->brand }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="sku">SKU</label>
                    @if ($product->sku)
                        <input type="text" class="form-control" name="sku" value="{{ $product->sku }}" readonly>
                    @else
                        <input type="text" class="form-control" name="sku" value="{{ $generatedSku }}" readonly>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="size">Size</label>
                    <input type="text" class="form-control" name="size" value="{{ $product->size }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="is_featured">Is Featured</label>
                    <input type="checkbox" class="form-control" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }}>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="is_available">Is Available</label>
                    <input type="checkbox" class="form-control" name="is_available" value="1" {{ $product->is_available ? 'checked' : '' }}>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>

        </div>
    </div>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{!! session('success') !!}",
            });
        </script>
    @endif
@endsection
