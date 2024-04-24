<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_profile()
    {
        $user = Auth::user();
        return view('show_profile', compact('user'));
    }

    public function update_profile(Request $request)
    {
        $user = Auth::user();

        // Check if $user is an instance of User model
        if (!($user instanceof \App\Models\User)) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ];

        // If password field is provided, add password validation rules
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8';
        }

        // Validate the request
        $request->validate($rules);

        // Prepare data for update
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address
        ];

        // Update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update the user
        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
