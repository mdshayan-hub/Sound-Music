@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4 fw-bold text-uppercase">All Albums</h1>

    <!-- Add Album Button -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('albums.create') }}" class="btn btn-dark btn-lg rounded-pill shadow-sm px-4">
            <i class="fas fa-plus"></i> Add Album
        </a>
    </div>

    <!-- Albums Table in a Stylish Card -->
    <div class="card shadow-lg border-0 rounded-3 p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-dark text-light text-uppercase">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Artist</th>
                        <th>Image</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($albums as $index => $album)
                        <tr class="align-middle">
                            <td class="fw-bold">{{ $index + 1 }}</td> <!-- Corrected Row Number -->
                            <td class="fw-semibold">{{ $album->title }}</td>
                            <td class="text-muted">{{ \Str::limit($album->description, 50) }}</td>
                            <td class="fw-semibold text-primary">{{ $album->artist_name }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $album->album_cover) }}" 
                                     alt="Album Cover" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td class="text-center">
                                <!-- Edit Button -->
                                <a href="{{ route('albums.edit', $album) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                
                                <!-- Delete Button -->
                                <form action="{{ route('albums.destroy', $album) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this album?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection
