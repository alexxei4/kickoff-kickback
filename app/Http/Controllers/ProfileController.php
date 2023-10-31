<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;




class ProfileController extends Controller
{
    public function showUpdateForm()
    {
        return view('profile.show'); 
    }

    public function updateProfilePicture(Request $request)
    {
        $user = auth()->user();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
            $user->save();

            return redirect()->route('profile.show')->with('success', 'Profile picture updated.');
        } else {
            return redirect()->route('profile.show')->with('error', 'No file uploaded.');
        }
    }

    public function show()
    {
        $user = auth()->user();

        return view('profile.show', ['user' => $user]);
    }


}
