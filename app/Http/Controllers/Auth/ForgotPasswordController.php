<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ResetPasswordNotification;
use App\Models\User;
use Illuminate\Support\Facades\Password; // Import Password facade

class ForgotPasswordController extends Controller
{
    // ...

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->sendResetLinkFailedResponse($request, 'email');
        }

        // Generate the password reset token
        $token = Password::createToken($user);

        // Send the password reset notification
        $user->notify(new ResetPasswordNotification($token));

        return $this->sendResetLinkResponse($request, 'passwords.sent');
    }

    use SendsPasswordResetEmails;
}
