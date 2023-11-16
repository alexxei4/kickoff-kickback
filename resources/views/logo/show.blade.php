@extends('layouts.frontendlayout')

@section('content')
    <div class="container mt-5">
        <h1>Change Logo</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . (auth()->check() ? auth()->user()->logo : 'images/KickOffKickBack.png')) }}" alt="My Store Logo" class="img-fluid mb-3">
            </div>

            <div class="col-md-6">
            <form method="POST" action="{{ route('profile.updateLogo') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="logo" class="form-label">Update Logo:</label>
                    <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Logo</button>
                </div>
            </form>

            </div>
        </div>
    </div>
@endsection
