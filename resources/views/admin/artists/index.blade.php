@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-lg">
        <div class="card-header  d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Artists</h3>
            <a href="{{ route('artists.create') }}" class="btn btn-dark text-light me-5 py-2 fw-bold">+ Add New Artist</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Bio</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artists as $artist)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    @if($artist->image)
                                        <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" class="rounded-circle" width="50" height="50">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $artist->name }}</td>
                                <td class="text-muted">{{ $artist->bio ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('artists.edit', $artist->id) }}" class="btn btn-sm btn-primary my-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger my-1" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3">
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle"></i> No artists found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
