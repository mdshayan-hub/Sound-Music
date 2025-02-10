@extends('user.welcome')

@section('content')

    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{asset('user/img/bg-img/breadcumb3.jpg')}});">
        <div class="bradcumbContent">
            <p>See what’s new</p>
            <h2>Login</h2>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Login Area Start ##### -->
    <section class="login-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="login-content">
                        <h3>Welcome Back</h3>
                        <!-- Login Form -->
                        <div class="login-form">
                            <form action="/authLogin" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter E-mail" value="{{ old('email') }}">
                                    
                                    <!-- Display error message for email if exists -->
                                    @if ($errors->has('email'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            <i class="fa fa-lock mr-2"></i>{{ $errors->first('email') }}
                                        </small>
                                    @else
                                        <small id="emailHelp" class="form-text text-muted">
                                            <i class="fa fa-lock mr-2"></i>We'll never share your email with anyone else.
                                        </small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    
                                    <!-- Display error message for password if exists -->
                                    @if ($errors->has('password'))
                                        <small class="form-text text-danger">
                                            <i class="fa fa-lock mr-2"></i>{{ $errors->first('password') }}
                                        </small>
                                    @endif
                                </div>
                                <button type="submit" class="btn oneMusic-btn mt-30">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <!-- ##### Login Area End ##### -->
    
@endsection