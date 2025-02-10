@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <h1 class="text-center text-light bg-dark p-3">Edit Artist</h1>

            <!-- Card for the form -->
            <div class="card shadow-lg rounded p-5">
                <form action="{{ route('artists.update', $artist->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Artist Name -->
                    <div class="form-group mb-4">
                        <label for="name" class="form-label fs-5 fw-bold">Artist Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-lg" id="name" value="{{ $artist->name }}" required>
                        <div class="form-text">Enter the updated name of the artist.</div>
                    </div>

                    <!-- Artist Bio -->
                    <div class="form-group mb-4">
                        <label for="bio" class="form-label fs-5 fw-bold">Bio</label>
                        <textarea name="bio" class="form-control form-control-lg" id="bio" rows="5">{{ $artist->bio }}</textarea>
                        <div class="form-text">Update the artist's biography here.</div>
                    </div>

                    <!-- Artist Image -->
                    <div class="form-group mb-4">
                        <label for="image" class="form-label fs-5 fw-bold">Artist Image</label>
                        <input type="file" name="image" class="form-control form-control-lg" id="image" accept="image/*">
                        @if($artist->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $artist->image) }}" alt="Artist Image" class="img-thumbnail" width="150">
                            </div>
                        @endif
                        <div class="form-text">Upload a new image for the artist (optional).</div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">Update Artist</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
