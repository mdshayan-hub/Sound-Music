<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Dashboard (Extra method, not part of resourceful controller)
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Display a listing of the resource (index)
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('admin.users.index', compact('users'));
    }

    // Show the form for creating a new resource (create)
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a newly created resource in storage (store)
    public function store(Request $request)
    {   

         // Form validation with image validation
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string',
        'address' => 'required|string|max:255',
        'phone_number' => 'required|numeric',
        'role' => 'required|string',
        'user_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image
    ]);



        $imageName = null;

        if ($request->hasFile('user_image')) {
            $imageName = time() . '.' . $request->user_image->extension();
            $request->user_image->move(public_path('storage/users'), $imageName); // Save image
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'user_image' => $imageName,
        ]);

         // Check the role and redirect accordingly
         if ($request->role === 'Admin') {
            return redirect()->route('users.index')->with('success', 'Admin registered successfully!');
        } else {
            return redirect()->route('login')->with('success', 'User registered successfully! Please login.');
        }
        
    }

    // Display the specified resource (show)
    public function show($id)
    {
        $user = User::findOrFail($id); // Fetch user by ID
        return view('admin.show', compact('user'));
    }

    // Show the form for editing the specified resource (edit)
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update the specified resource in storage (update)
    public function update(Request $request, User $user)
    {
        $imageName = $user->user_image; // Keep the old image if no new image is uploaded

        if ($request->hasFile('user_image')) {
            $imageName = time() . '.' . $request->user_image->extension();
            $request->user_image->move(public_path('storage/users'), $imageName);

            // Optional: Delete old image
            if ($user->user_image && file_exists(public_path('storage/users/' . $user->user_image))) {
                unlink(public_path('storage/users/' . $user->user_image));
            }
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'user_image' => $imageName,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Remove the specified resource from storage (destroy)
    public function destroy(User $user)
    {
        if ($user->user_image && file_exists(public_path('storage/users/' . $user->user_image))) {
            unlink(public_path('storage/users/' . $user->user_image));
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

    // public function showLoginForm()
    // {
    //     return view('admin.users.login'); // Ensure this Blade file exists in views/admin/
    // }

    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt($credentials, $request->remember)) {
    //         return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
    //     }

    //     return back()->with('error', 'Invalid credentials');
    // }




    public function logout(Request $request)
{
    Auth::logout();
    return redirect()->route('user.home');
}

}

?>
