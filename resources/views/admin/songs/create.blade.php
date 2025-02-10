@extends('admin.layout')

@section('content')
<div class="container mt-5 h-100">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-center">
                    <h3 class="mb-0 text-light">Add New Song</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Song Title</label>
                            <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Enter song title" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="album" class="form-label">Album</label>
                            <select id="album" name="album" class="form-control" required>
                                <option value="">Select Album</option>
                                @foreach ($album as $alb)
                                    <option value="{{ $alb->id }}">{{ $alb->title }}</option>
                                @endforeach
                            </select>
                            @error('album')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="music_type" class="form-label">Music Type</label>
                            <input type="text" class="form-control form-control-lg" id="music_type" name="music_type" placeholder="Enter music type" required>
                            @error('music_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="music_file" class="form-label">Music File</label>
                            <input type="file" class="form-control form-control-lg" id="music_file" name="music_file" required>
                            @error('music_file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="music_cover" class="form-label">Music Cover</label>
                            <input type="file" class="form-control form-control-lg" id="music_cover" name="music_cover" required>
                            @error('music_cover')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control form-control-lg" id="year" name="year" placeholder="Enter release year" required>
                            @error('year')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <input type="text" class="form-control form-control-lg" id="genre" name="genre" placeholder="Enter music genre" required>
                            @error('genre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="language" class="form-label">Language</label>
                            <input type="text" class="form-control form-control-lg" id="language" name="language" placeholder="Enter language" required>
                            @error('language')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Save Song</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
