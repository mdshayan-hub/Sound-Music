<?php

use App\Http\Controllers\userController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

// USER ROUTES --------------------------------

// HOME / route
Route::get('/', [userController::class, 'home']);

// Home route
Route::get('/home', [userController::class, 'home']);

// Song route
Route::get('song', [userController::class, 'song']);

// Video route
Route::get('video', [userController::class, 'video']);

// Login route
Route::get('login', [userController::class, 'showLogin']);

// Album route
Route::get('album', [userController::class, 'album']);

// Event routes
Route::get('event', [userController::class, 'event']);

// News routes
Route::get('news', [userController::class, 'news']);

// Contact routes
Route::get('contact', [userController::class, 'contact']);

// Elements routes
Route::get('elements', [userController::class, 'elements']);

// Contact form submit handle karne ke liye (POST request)
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/register', [AdminController::class, 'store'])->name('users.store');



// routes/web.php
Route::middleware(['guest'])->group(function () {
    // Authentication Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/authLogin', [AuthController::class, 'authLogin']);
    
    // Register routes
    Route::post('/registerDone', [AdminController::class, 'store']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

});




// User Routes
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/home', [UserController::class, 'home'])->name('user.home');
    Route::get('/user/album', [userController::class, 'album']);
    Route::get('/user/song', [UserController::class, 'song'])->name('user.song');
    Route::get('/user/video', [UserController::class, 'video'])->name('user.video');
});


// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::resource('/admin/users', AdminController::class);
Route::resource('/admin/songs', SongController::class);
Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('admin.reviews');
Route::resource('/admin/reviews', ReviewController::class)->except(['index', 'show']);
    Route::resource('/admin/artists', ArtistController::class);
    Route::resource('/admin/albums', AlbumController::class);
    Route::get('/song', [UserController::class, 'song'])->name('user.song');
    Route::get('/video', [UserController::class, 'video'])->name('user.video');

});
// Agar koi unauthenticated user `/song` ya `/video` pe jaye to usko home pe redirect karo



Route::get('/stream-audio/{filename}', [SongController::class, 'streamAudio']);
