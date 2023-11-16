@extends('layouts.adminlayout')
<head>
@section('title', 'Add New Product')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
@section('content')

<div class="card">
    <div class="card-body">
        <h1>Add New Product</h1>
        <form action="{{ url('add-product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category_id">Category</label>
                    <select class="form-control" name="category_id">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description">Description</label>
                    <textarea rows="3" class="form-control" name="description" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cost">Cost</label>
                    <input type="number" step="any" class="form-control" name="cost" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" name="quantity" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" required>
                </div>
                <div class="col-md-12">
                    <label for="is_featured" class="form-check-label">Is Featured</label>
                    <input type="checkbox" class="form-check-input" name="is_featured" value="1">
                </div>
                <div class="col-md-12">
                    <label for="is_available" class="form-check-label">Is Available</label>
                    <input type="checkbox" class="form-check-input" name="is_available" value="1">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" name="brand">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="size">Size</label>
                    <input type="text" class="form-control" name="size" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" name="color" required>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
            html: "{!! session('success') !!}",
        });
    </script>
@endif

@endsection
