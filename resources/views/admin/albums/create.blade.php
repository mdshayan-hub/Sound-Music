@extends('admin.layout')
@section('content')
<div class="container mt-4">
   <div class="row justify-content-center">
    <div class="col-lg-8">
            <!-- Title -->
    <h1 class="text-center mb-4 text-light bg-dark p-3 rounded">Add New Album</h1>

    <!-- Form Card -->
    <div class="card shadow-lg rounded p-5">
        <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Album Title -->
            <div class="form-group mb-4">
                <label for="title" class="form-label fs-5 fw-bold">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control form-control-lg" id="title" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-text">Enter the album title.</div>
            </div>
        
            <!-- Album Cover Upload -->
            <div class="form-group mb-4">
                <label for="album_cover" class="form-label fs-5 fw-bold">Album Cover</label>
                <input type="file" name="album_cover" class="form-control form-control-lg" id="album_cover" accept="image/*" required>
                @error('album_cover')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-text">Upload an image for the album cover.</div>
            </div>
        
            <!-- Album Description -->
            <div class="form-group mb-4">
                <label for="description" class="form-label fs-5 fw-bold">Description</label>
                <textarea name="description" class="form-control form-control-lg" id="description" rows="4"></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-text">Provide a short description of the album.</div>
            </div>
        
            <!-- Select Artist -->
            <div class="form-group mb-4">
                <label for="artist_id" class="form-label fs-5 fw-bold">Artist <span class="text-danger">*</span></label>
                <select name="artist_id" id="artist_id" class="form-control form-control-lg" required>
                    <option value="">Select Artist</option>
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                    @endforeach
                </select>
                @error('artist_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-text">Select the artist for this album.</div>
            </div>
        
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">Save Album</button>
        </form>
        
    </div>
    </div>
   </div>
</div>
@endsection
