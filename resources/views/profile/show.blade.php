@extends('layouts.frontendlayout')

@section('content')
    <h1>Your Profile</h1>
    <p>Welcome, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
    <img src="{{ asset('storage/app/public/' . Auth::user()->profile_picture) }}" alt="Profile Picture">

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="profile_picture">Update Profile Picture:</label>
        <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
        <button type="submit">Upload</button>
    </form>
@endsection
