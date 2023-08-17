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

<div class="card-header"></div>

<div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Role</th>
                <th>Email</th>
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
                <td class="actions-btns">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                        <i class="nc-icon nc-ruler-pencil"></i> Edit
                    </a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger delete-user">
                            <i class="nc-icon nc-simple-remove"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.delete-user').click(function(event) {
            event.preventDefault();
            const form = $(this).closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

