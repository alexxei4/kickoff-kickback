@extends('layouts.adminlayout')

@section('title', 'Products')

@section('content')
<style>
    .actions-btns {
        display: flex;
        gap: 10px;
    }
</style>
<h1>Products</h1>

<div class="card-header">

</div>
<div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Cost</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Image</th>
                <th>Is Featured</th>
                <th>Is Available</th>
                <th>Brand</th>
                <th>SKU</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->slug }}</td>
            <td>{{ $product->cost }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->description }}</td>
            <td>
                <img src="{{ asset('/public/assets/uploads/product/'.$product->image) }}" alt="Image" style="width: 100px; height: 100px;">
            </td>
            <td>{{ $product->is_featured ? 'Yes' : 'No' }}</td>
            <td>{{ $product->is_available ? 'Yes' : 'No' }}</td>
            <td>{{ $product->brand }}</td>
            <td>{{ $product->sku }}</td>
            <td><a href="{{ route('edit.product', $product->id) }}" class="btn btn-primary"><i class="nc-icon nc-ruler-pencil"></i></a> </td>
            <td>

                <form action="{{  route('admin.product.delete-product', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
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
