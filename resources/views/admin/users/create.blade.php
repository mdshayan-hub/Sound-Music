@extends('admin.layout') <!-- Shared layout file -->
@section('content')
<div class="container mt-5 h-100">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark  text-center">
                    <h3 class="mb-0 text-light">Add New User</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Enter user name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter user email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter password" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control form-control-lg" id="address" name="address" placeholder="Enter user address" required>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="phone_number" class="form-label">Phone</label>
                            <input type="number" class="form-control form-control-lg" id="phone_number" name="phone_number" placeholder="Enter phone number" required>
                            @error('phone_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select form-select-lg" id="role" name="role" required>
                                <option value="" disabled selected>Select role</option>
                                <option value="User">User</option>
                                <option value="Admin">Admin</option>
                            </select>
                            @error('role')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="user_image" class="form-label">User Image</label>
                            <input type="file" class="form-control form-control-lg" id="user_image" name="user_image" accept="image/*">
                            @error('user_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <input type="hidden" name="role" value="Admin">
                        <div class="d-grid col-lg-3">
                            <button type="submit" class="btn btn-primary btn-lg">Add User</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
