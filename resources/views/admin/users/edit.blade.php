@extends('layouts.adminlayout')

@section('title', 'Edit User')

@section('content')
    <h1>Edit Category</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" name="firstname" value="{{ $user->firstname }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" name="new_password">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirm_new_password">Confirm New Password</label>
                        <input type="password" class="form-control" name="confirm_new_password">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="role">Role</label>
                        <select name="role" class="form-control">
                            <option value="0" {{ old('role', $user->role) == 0 ? 'selected' : '' }}>User</option>
                            <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Admin</option>
                        </select>
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