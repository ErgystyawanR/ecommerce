<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function users()
    {
        $users = User::latest()->paginate(5);
        return view('user_management', compact('users'));
    }

    public function create_admin($userId)
    {
        $user = User::find($userId);

        if ($user) {
            // Update user role to 'admin' and set is_admin to true
            $user->update([
                'role' => 'admin',
                'is_admin' => true,
            ]);
        }

        return redirect()->back()->with('success', 'User role updated to admin successfully.');
    }
    public function create_user($userId)
    {
        $user = User::find($userId);

        if ($user) {
            // Update user role to 'admin' and set is_admin to true
            $user->update([
                'role' => 'user',
                'is_admin' => false,
            ]);
        }

        return redirect()->back()->with('success', 'User role updated to user successfully.');
    }

    public function add_user()
    {
        return view('add_user');
    }
    public function store_user(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin', // Ensure role is either 'user' or 'admin'
            'address' => 'required',
        ]);

        // Create the user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->address = $validatedData['address'];
        $user->save();

        // Redirect back with success message
        return redirect()->route('user_management')->with('success', 'User created successfully.');
    }

    public function delete_user(User $user)
    {
        $user->delete();

        // Set pesan flash
        Session::flash('success', 'User deleted successfully.');
        return redirect()->route('user_management');
    }
}
