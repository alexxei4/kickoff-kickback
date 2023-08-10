@extends('layouts.adminlayout')

@section('title', 'Users')

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
                <th>firstname</th>
                <th>lastname</th>
                <th>role</th>
                <th>email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->firstname }} </td>
            <td>{{ $user->lastname}}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->email }}</td>
            <td> <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary"><i class="nc-icon nc-ruler-pencil"></i></a> </td>
            <td> 
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
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
