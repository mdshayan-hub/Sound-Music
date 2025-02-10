@extends('user.welcome')

@section('content')

    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('user/img/bg-img/breadcumb3.jpg') }});">
        <div class="bradcumbContent">
            <p>See what’s new</p>
            <h2>Register</h2>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Register Area Start ##### -->
    <section class="login-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="login-content">
                        <h3>Create Your Account</h3>
                        <!-- Register Form -->
                        <div class="login-form">
                            <form action="/registerDone" method="POST" enctype="multipart/form-data">
                              @csrf
                                <!-- Name Field -->
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Your Full Name" required>
                                </div>

                                <!-- Email Field -->
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter E-mail" required>
                                    <small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>We'll never share your email with anyone else.</small>
                                </div>

                                <!-- Password Field -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                </div>

                                <!-- Phone Number Field -->
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter Phone Number" required>
                                </div>

                                <!-- Address Field -->
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" class="form-control" id="address" rows="3" placeholder="Enter Address" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select form-select-lg" id="role" name="role" required>
                                        
                                        <option value="User">User</option>
                                        <option value="User">Admin</option>
                                    </select>
                                </div>

                                <input type="hidden" name="role" value="User">
                                <!-- User Image Field -->
                                <div class="form-group">
                                    <label for="user_image">Profile Picture</label>
                                    <input type="file" name="user_image" class="form-control-file" id="user_image" accept="image/*" required>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn oneMusic-btn mt-30">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Register Area End ##### -->

@endsection
