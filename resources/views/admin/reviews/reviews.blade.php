@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">All Reviews</h2>

    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Song</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                <tr>
                    <td class="fw-bold">{{ $review->id }}</td>
                    <td>{{ $review->user->name ?? 'Guest' }}</td>
                    <td class="fw-semibold">{{ $review->song->title ?? 'Unknown Song' }}</td>
                    <td>{{ $review->review_text }}</td>
                    <td>
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                        @endfor
                    </td>
                    <td>
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
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
@endsection
