<?php

namespace App\Http\Controllers;

use App\Notifications\VerifyEmailNotification;
use App\Services\VerificationEmailService;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function __construct(private VerificationEmailService $verificationEmailService )
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect('/home')->with('Pending', 'Already verified.');
        }
        return null;
    }

    public function notice()
    {
        return view('auth.emailVarify');
    }
    public function verify(EmailVerificationRequest $request)
    {
        try{
            $this->verificationEmailService->update($request);
        }
        catch (\Exception $e){
            return redirect('/Home')->with('Failed', $e->getMessage());
        }

        return redirect('/Home')->with('Success', 'Email verified! Account is now active.');
    }

    public function resend(Request $request)
    {
        $request->user()->notify(new VerifyEmailNotification());
        return back()->with('Success', 'Verification link resent! Check your inbox.');
    }

}
