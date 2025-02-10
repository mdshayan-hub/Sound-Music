@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 ">
            <h1 class="text-center text-light bg-dark  p-3">Add New Artist</h1>

<!-- Card for the form -->
<div class="card shadow-lg rounded p-5">
    <form action="{{ route('artists.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Artist Name -->
        <div class="form-group mb-4">
            <label for="name" class="form-label fs-5 fw-bold">Artist Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control form-control-lg" id="name" required>
            <div class="form-text">Enter the full name of the artist.</div>
        </div>

        <!-- Artist Bio -->
        <div class="form-group mb-4">
            <label for="bio" class="form-label fs-5 fw-bold">Bio</label>
            <textarea name="bio" class="form-control form-control-lg" id="bio" rows="5"></textarea>
            <div class="form-text">Provide a brief biography for the artist.</div>
        </div>

        <!-- Artist Image -->
        <div class="form-group mb-4">
            <label for="image" class="form-label fs-5 fw-bold">Artist Image <span class="text-danger">*</span></label>
            <input type="file" name="image" class="form-control form-control-lg" id="image" accept="image/*" required>
            <div class="form-text">Upload an image of the artist.</div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">Save Artist</button>
    </form>
</div>
        </div>
    </div>
</div>
@endsection
