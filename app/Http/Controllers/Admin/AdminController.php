<?php
// app/Http/Controllers/Admin/AdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    
    public function index()
    {
        return view('adminlayout');
    }
    

    public function sales()
    {
        // Fetch sales/analytics data here
        return view('admin.sales'); // Create a corresponding view file
    }

    public function users()
    {
        $users = User::all(); // Fetch user data
        return view('admin.users.users', compact('users')); // Create a corresponding view file
    }
    // AdminController.php or UserController.php

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email',
        'new_password' => 'nullable|string|max:255', // Remove 'required'
        'confirm_new_password' => 'nullable|string|max:255|same:new_password', // Add 'confirmed'
        'role' => 'required|integer|between:0,1',
    ]);

    $user->update($validatedData);

    if ($request->filled('new_password')) {
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
    }

    return redirect()->route('admin.users.users')->with('success', 'User updated successfully!');
}


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user')->with('success', 'User deleted successfully!');
    }



}
