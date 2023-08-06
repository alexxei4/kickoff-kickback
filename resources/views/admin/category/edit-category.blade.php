@extends('layouts.adminlayout')

@section('title', 'Edit Category')

@section('content')
    <h1>Edit Category</h1>

    <div class="card">
        <div class="card-body">
        <form action="{{ route('update.category', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" value="{{ $category->slug }}">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description">Description</label>
                    <textarea rows="3" class="form-control" name="description">{{ $category->description }}</textarea>
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
