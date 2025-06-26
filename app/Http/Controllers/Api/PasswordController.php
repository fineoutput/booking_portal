<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Employee;
use App\Notifications\EmployeeResetPasswordNotification;


class PasswordController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:agent,email', 
        ]);
    
        Log::info('Password reset link requested for email: ' . $request->email);
    
        $status = Password::broker('agent')->sendResetLink(
            $request->only('email'),
            function ($user, $token) use ($request) {
                $user->notify(new EmployeeResetPasswordNotification($token, $request->email));
            }
        );
    
        if ($status === Password::RESET_LINK_SENT) {
            Log::info('Password reset link sent successfully to email: ' . $request->email);
            return response()->json(
                [
                 'status' => 200,
                 'message' => 'Reset link sent to your email.',
                ]);

        } else {
            Log::error('Failed to send password reset link to email: ' . $request->email . '. Error: ' . $status);
             return response()->json(
                [
                 'status' => 200,
                 'message' => 'Unable to send reset link.',
                ]);
        }
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:agent,email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::broker('agent')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($employee, $password) {
                $employee->password = Hash::make($password);
                $employee->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['status' => true, 'message' => 'Password has been reset.'])
            : response()->json(['status' => false, 'message' => 'Invalid token or email.'], 500);
    }


}
