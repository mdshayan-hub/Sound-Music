@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0 text-center text-light">Update Song Details</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('songs.update', $song->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Row 1: Title and Artist -->
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="title" class="form-label fw-bold">Song Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $song->title }}" placeholder="Enter song title" required>
                    </div>
                </div>

                <!-- Row 2: Album and Music Type -->
                <div class="row g-4 mt-3">
                    <div class="col-md-6">
                        <select class="form-control" id="album" name="album" required>
                            <option value="">Select Album</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}" 
                                    {{ $song->album == $album->id ? 'selected' : '' }}>
                                    {{ $album->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="music_type" class="form-label fw-bold">Music Type</label>
                        <input type="text" class="form-control" id="music_type" name="music_type" value="{{ old('music_type', $song->music_type ?? '') }}" placeholder="e.g., Rock, Pop" required>
                    </div>
                </div>

                <!-- Row 3: Music File and Music Cover -->
                <div class="row g-4 mt-3">
                    <div class="col-md-6">
                        <label for="music_file" class="form-label fw-bold">Music File</label>
                        <input type="file" class="form-control" id="music_file" name="music_file">
                        @if (isset($song->music_file))
                            <small class="text-muted d-block mt-2">Current File: <a href="{{ asset('storage/' . $song->music_file) }}" target="_blank" class="text-decoration-none">View File</a></small>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="music_cover" class="form-label fw-bold">Music Cover</label>
                        <input type="file" class="form-control" id="music_cover" name="music_cover">
                        @if (isset($song->music_cover))
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $song->music_cover) }}" alt="Current Cover" class="img-thumbnail" width="100">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Row 4: Year, Genre, and Language -->
                <div class="row g-4 mt-3">
                    <div class="col-md-4">
                        <label for="year" class="form-label fw-bold">Year</label>
                        <input type="number" class="form-control" id="year" name="year" value="{{ $song->year }}" placeholder="Release year" required>
                    </div>
                    <div class="col-md-4">
                        <label for="genre" class="form-label fw-bold">Genre</label>
                        <input type="text" class="form-control" id="genre" name="genre" value="{{ $song->genre }}" placeholder="e.g., Pop, Jazz" required>
                    </div>
                    <div class="col-md-4">
                        <label for="language" class="form-label fw-bold">Language</label>
                        <input type="text" class="form-control" id="language" name="language" value="{{ $song->language }}" placeholder="e.g., English, Hindi" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-info w-50 fw-bold">Update Song</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
