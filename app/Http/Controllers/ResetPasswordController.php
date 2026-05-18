<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailValidation;
use App\Http\Requests\ResetPassword;
use App\Services\ResetPasswordService;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function __construct(private ResetPasswordService $resetPasswordService){}

    public function showForgotPasswordPage()
    {
        return view('auth.resetPasswordEmailForm');

    }

    public function sendResetLinkEmail(EmailValidation $request)
    {
        try {
            $this->resetPasswordService->handleResetPasswordMessage($request);
            return back()->with('Success', 'Reset password code sent to your email.');
        }
        catch (\Exception $exception){
            return back()->with('Failed', $exception->getMessage());
        }
    }

    public function showResetPasswordPage(Request $request)
    {
        return view('auth.changePasswordForm' , [
            'email' => $request->query('email')]);
    }

    public function resetPassword(ResetPassword $request)
    {
        try {
            $this->resetPasswordService->handleChangePassword($request);
        }
        catch (\Exception $exception){
            return back()->with('Failed', $exception->getMessage());
        }

        return redirect()->route('LogIn')->with('Success', 'Password changed successfully.');
    }
}
