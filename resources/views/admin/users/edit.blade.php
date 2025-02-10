@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0 text-center text-light">Edit User Details</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Row 1: Name and Email -->
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Enter full name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Enter email address" required>
                    </div>
                </div>

                <!-- Row 2: Address and Phone -->
                <div class="row g-4 mt-3">
                    <div class="col-md-6">
                        <label for="address" class="form-label fw-bold">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" placeholder="Enter address" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label fw-bold">Phone</label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" placeholder="Enter phone number" required>
                    </div>
                </div>

                <!-- Row 3: Role and User Image -->
                <div class="row g-4 mt-3">
                    <div class="col-md-6">
                        <label for="role" class="form-label fw-bold">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="user_image" class="form-label fw-bold">User Image</label>
                        <input type="file" class="form-control" id="user_image" name="user_image" accept="image/*">
                        @if ($user->user_image)
                            <div class="mt-2">
                                <p class="text-muted mb-1">Current Image:</p>
                                <img src="{{ asset('storage/users/' . $user->user_image) }}" alt="User Image" class="img-thumbnail" width="100">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-info w-50 fw-bold">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
