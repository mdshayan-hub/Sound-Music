@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">All Songs</h2>
        <a href="{{ route('songs.create') }}" class="btn btn-outline-dark shadow-sm">Add New Song</a>
    </div>

    @if(session('success'))
        <div class="alert alert-dark text center shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
<table class="table table-bordered table-striped table-hover shadow-sm">
    <thead class="bg-dark text-light text-center">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Album</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Language</th>
            <th>Music Type</th>
            <th>Music Cover</th>
            <th>Music File</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($songs as $song)
        <tr class="text-center align-middle">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $song->title }}</td>
            <td>{{ $song->album_title ?? 'No Album' }}</td> <!-- Show album title here -->
            <td>{{ $song->year }}</td>
            <td>{{ $song->genre }}</td>
            <td>{{ $song->language }}</td>
            <td>{{ $song->music_type }}</td>
            <td>
                <img src="{{ asset('storage/' . $song->music_cover) }}" class="rounded border border-secondary" alt="Cover" width="80">
            </td>
            <td>
                @if($song->music_file)
                   <a href="{{ route('songs.show', $song) }}" class="btn btn-sm btn-outline-dark">View</a>
                @else
                    <span class="text-muted">N/A</span>
                @endif
            </td>
            <td>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('songs.edit', $song) }}" class="btn btn-sm btn-info text-dark me-2">Edit</a>
                    <form action="{{ route('songs.destroy', $song) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    </div>
</div>
@endsection
