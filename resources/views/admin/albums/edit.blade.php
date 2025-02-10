@extends('admin.layout')

@section('content')
<div class="container mt-4">
<div class="row justify-content-center">
    <div class="col-lg-8">
            <!-- Title -->
    <h1 class="text-center mb-4 text-light bg-dark p-3 rounded">Edit Album</h1>

    <!-- Form Card -->
    <div class="card shadow-lg rounded p-5">
        <form action="{{ route('albums.update', $album) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- Album Title -->
            <div class="form-group mb-4">
                <label for="title" class="form-label fs-5 fw-bold">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control form-control-lg" id="title" value="{{ $album->title }}" required>
                <div class="form-text">Update the album title.</div>
            </div>

            <div class="form-group mb-4">
                <label for="album_cover" class="form-label fs-5 fw-bold">Album Cover</label>
                <input type="file" name="album_cover" class="form-control form-control-lg" id="album_cover" accept="image/*">
                <div class="form-text">Upload an image for the album cover.</div>
                </div>

                <img src="{{ asset('storage/' . $album->album_cover) }}" alt="">


            <!-- Album Description -->
            <div class="form-group mb-4">
                <label for="description" class="form-label fs-5 fw-bold">Description</label>
                <textarea name="description" class="form-control form-control-lg" id="description" rows="4">{{ $album->description }}</textarea>
                <div class="form-text">Update the album's description.</div>
            </div>

            <!-- Select Artist -->
            <div class="form-group mb-4">
                <label for="artist_id" class="form-label fs-5 fw-bold">Artist <span class="text-danger">*</span></label>
                <select name="artist_id" id="artist_id" class="form-control form-control-lg" required>
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}" {{ $album->artist_id == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                    @endforeach
                </select>
                <div class="form-text">Select the artist for this album.</div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">Update Album</button>
        </form>
    </div>
    </div>
</div>
</div>
@endsection
