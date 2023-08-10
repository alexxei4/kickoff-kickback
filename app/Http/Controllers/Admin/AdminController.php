<?php
// app/Http/Controllers/Admin/AdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\User;

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
        // Validate the incoming data
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' ,
            'password' => 'required|string|max:255',
            'role' => 'required|integer|between:0,1',
            
          
        ]);

        // Update the user with validated data
        $user->update($validatedData);

        return redirect()->route('user')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user')->with('success', 'User deleted successfully!');
    }



}
