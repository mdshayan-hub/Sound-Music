<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>One Music - Modern Music HTML5 Template</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('user/img/core-img/favicon.ico')}}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('user/style.css') }}">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Navbar Area -->
        <div class="oneMusic-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="oneMusicNav">

                        <!-- Nav brand -->
                        <a href="home" class="nav-brand"><img src="{{asset('user/img/core-img/logo.png')}}" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="home">Home</a></li>
                                    <li><a href="album">Albums</a></li>
                                    
                                        @if (Auth::check())
                                            <li><a href="{{ route('user.song') }}">Songs</a></li>
                                            <li><a href="{{ route('user.video') }}">Videos</a></li>
                                        @else

                                        @endif
                                    
                                    
                                    <li><a href="event">Events</a></li>
                                    <li><a href="news">News</a></li>
                                    <li><a href="contact">Contact</a></li>
                                </ul>

                                @if (Auth::check())
                            <!-- Login/Register & Cart Button -->
                                <div class="login-register-cart-button d-flex align-items-center">
                                    <!-- Login/Register -->
                                    <div class="login-register-btn mr-50">
                                        <a href="/logout" id="loginBtn">Logout </a>
                                    </div>
    
                                </div>
    
                                @else
                                <!-- Login/Register & Cart Button -->
                                <div class="login-register-cart-button d-flex align-items-center">
                                    <!-- Login/Register -->
                                    <div class="login-register-btn mr-50">
                                        <a href="login" id="loginBtn">Login / <a href='register' >&nbsp;Register</a> </a>
                                    </div>

                                    
                                </div>
    
                                @endif

                            </div>
                            <!-- Nav End -->

                        </div>
                    </nav>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->


@yield('content')



<!-- ##### Contact Area Start ##### -->
<section class="contact-area section-padding-100 bg-img bg-overlay bg-fixed has-bg-img" style="background-image: url({{ asset('user/img/bg-img/bg-2.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading white">
                    <p>See what’s new</p>
                    <h2>Get In Touch</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Contact Form Area -->
                <div class="contact-form-area">
                    <!-- Display Success Message -->
                    <div id="success-message" class="alert alert-transparent text-light" style="display: none;"></div>

                    {{-- <!-- Display Validation Errors -->
                    <div id="error-message" class="alert alert-light text-danger" style="display: none;">
                        <ul id="error-list"></ul>
                    </div> --}}

                    <form id="contact-form" action="{{ route('contact.submit') }}" method="POST">
                        @csrf <!-- CSRF Token for Security -->
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                                    <small class="text-danger" id="name-error"></small>
                                </div>
                            </div>
                            <!-- Email Field -->
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}">
                                    <small class="text-danger" id="email-error"></small>
                                </div>
                            </div>
                            <!-- Subject Field -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="{{ old('subject') }}">
                                    <small class="text-danger" id="subject-error"></small>
                                </div>
                            </div>
                            <!-- Message Field -->
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message">{{ old('message') }}</textarea>
                                    <small class="text-danger" id="message-error"></small>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="col-12 text-center">
                                <button class="btn oneMusic-btn mt-30" type="submit">Send <i class="fa fa-angle-double-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Contact Area End ##### -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#contact-form').on('submit', function (e) {
            e.preventDefault(); // Prevent the form from submitting normally

            // Clear previous errors
            $('#error-message').hide();
            $('#error-list').empty();
            $('.text-danger').text('');

            // Serialize form data
            let formData = $(this).serialize();

            // Send AJAX request
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function (response) {
                    // Display success message
                    $('#success-message').text(response.message).show();
                    $('#contact-form')[0].reset(); // Reset the form
                },
                error: function (xhr) {
                    // Display validation errors
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $('#' + key + '-error').text(value[0]); // Show error under each field
                        });
                        $('#error-message').show(); // Show the error message container
                    } else {
                        // Handle other errors
                        $('#error-list').append('<li>An error occurred. Please try again.</li>');
                        $('#error-message').show();
                    }
                }
            });
        });
    });
</script>

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container">
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-12 col-md-6">
                    <a href="#"><img src="img/core-img/logo.png" alt=""></a>
                    <p class="copywrite-text"><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">MD Shayan</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>

                <div class="col-12 col-md-6">
                    <div class="footer-nav">
                        <ul>
                            <li><a href="home">Home</a></li>
                            <li><a href="album">Albums</a></li>
                            <li><a href="event">Events</a></li>
                            <li><a href="news">News</a></li>
                            <li><a href="contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{asset('user/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('user/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('user/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{asset('user/js/plugins/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('user/js/active.js')}}"></script>
</body>

</html>