<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected function authenticated(Request $request, $user)
    {
        if ($user->role_as == '1') {
            return redirect()->route('/dashboard'); // Assuming 'dashboard' is the route name for the admin dashboard
        } else {
            // For normal users, they will be redirected to the default page.
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        if (Auth::user()->role_as == '1') {
            return '/dashboard'; // Redirect admin users to the dashboard
        } else {
            return '/'; // Redirect normal or default users to the home page
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



       


}
