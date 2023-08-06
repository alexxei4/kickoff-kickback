@extends('layouts.adminlayout')

@section('title', 'Categories')

@section('content')

<style>
    .actions-btns {
        display: flex;
        gap: 10px;
    }
</style>
<h1>Categories</h1>

<div class="card-header">

</div>
<div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>{{ $category->description }}</td>
            <td> <a href="{{ route('edit.category', $category->id) }}" class="btn btn-primary"><i class="nc-icon nc-ruler-pencil"></i></a> </td>
            <td> 
                 <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="nc-icon nc-simple-remove"></i></button>
                </form>
            </td>

            
            
        </tr>
        @endforeach

        </tbody>
    </table>
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
