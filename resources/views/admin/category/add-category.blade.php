@extends('layouts.adminlayout')
<head>
@section('title', 'Add New Category')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


@section('content')

<div class="card">
    <div class="card-body">
        <h1>Add New Category</h1>
        <form action="{{ url('insert-category') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" step="any" class="form-control" name="slug">
                </div>
                <div class="col-md-12">
                    <label for="description">Description</label>
                    <textarea rows="3" class="form-control" name="description"></textarea>
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
            text: "{!! session('success') !!}",
        });
    </script>
@endif

@endsection
