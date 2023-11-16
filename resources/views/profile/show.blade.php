@extends('layouts.frontendlayout')

@section('content')
    <div class="container mt-5">
        <h1>Your Profile</h1>
        <p>Welcome, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>

        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/app/public/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="img-fluid mb-3">
            </div>

            <div class="col-md-6">
                <form method="POST" action="{{ route('profile.editLogo') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Update Profile Picture:</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name:</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="{{ Auth::user()->firstname }}">
                    </div>

                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name:</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" value="{{ Auth::user()->lastname }}">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
