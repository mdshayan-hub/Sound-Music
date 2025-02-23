<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLogin(){
        return view('user.login');
    }

    public function authLogin(Request $request) {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            // Agar user successfully login ho gaya
            $user = Auth::user();
            
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard'); // Admin ke liye redirect
            } else {
                return redirect()->route('user.home'); // User home page
            }
        }

        if (Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password
            ])) {
            return redirect()->intended('/home'); // Redirect to home after login
        }
    
        // If login fails, return back with an error (without page refresh)
        return redirect()->back()->withInput()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }
    
    

    public function logout(){
        Auth::logout();
        return redirect('/');
    }


    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Validate Form
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Admin login credentials
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard'); // Admin panel ka route
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function showRegisterForm()
{
    return view('user.register'); // Make sure this Blade file exists
}

// AuthController.php
public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'address' => 'required|string|max:255',
        'phone_number' => 'required|numeric',
        'role' => 'required|string',
        'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imageName = null;
    if ($request->hasFile('user_image')) {
        $imageName = time() . '.' . $request->user_image->extension();
        $request->user_image->move(public_path('storage/users'), $imageName);
    }

    $role = $request->role ?? 'user'; // Default 'User' if role is missing


    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'address' => $request->address,
        'phone_number' => $request->phone_number,
        'role' => $role,
        'user_image' => $imageName,
    ]);

    return redirect()->route('login')->with('success', 'Account created! Please login.');
}

}
