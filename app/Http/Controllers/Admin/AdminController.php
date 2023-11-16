<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// This is the controller for the user section in teh admin dashboard
class AdminController extends Controller
{
    // This displays the admin layout
    public function index()
    {
        return view('adminlayout');
    }
    
    // this displays the sales page in admin but unfortunately i couldnt get it working 
    public function sales()
    {
       
        return view('admin.sales.index');
    }
    // this displays all of the users who signed up on the app in the admin panel 
    public function users()
    {
        $users = User::all(); 
        return view('admin.users.users', compact('users')); 
    }
  
    // this pulls up the edit view for the users page in the admin dashboard 
    // ie pulls up the name and other information that you can edit about them
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    // This controls the update method , this is what makes the update HAPPEN , 
    // Edit just displays/gets the information meanwhile update actually does it 
    public function update(Request $request, User $user)
    {
    $validatedData = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email',
        'new_password' => 'nullable|string|max:255',
        'confirm_new_password' => 'nullable|string|max:255|same:new_password', 
        'role' => 'required|integer|between:0,1',
    ]);

    $user->update($validatedData);

    if ($request->filled('new_password')) {
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
    }

    return redirect()->route('admin.users.users')->with('success', 'User updated successfully!');
    }

    // This is responsible for deleting the user data
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.users')->with('success', 'User deleted successfully!');
    }



}
