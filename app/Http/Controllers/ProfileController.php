<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;



// this is the controller for the user profile
class ProfileController extends Controller
{
    // this displays the form where the user can update the profile picture
    public function showUpdateForm()
    {
        return view('profile.show'); 
    }
    // this updates the user profile
    public function updateProfilePicture(Request $request)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        if ($request->filled('firstname')) {
            $user->firstname = $request->input('firstname');
        }
    
        if ($request->filled('lastname')) {
            $user->lastname = $request->input('lastname');
        }
    
     
        $user->save();
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    
    }
    // this displays the profile picture
    public function show()
    {
        $user = auth()->user();

        return view('profile.show', ['user' => $user]);
    }


}
