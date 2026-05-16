<?php

namespace App\Services;

use Illuminate\Http\Request;

class VerificationEmailService
{
    public function update(Request $request): true
    {
        if(!$request->user()->update(['is_active' => true , 'email_verified_at' => now()])){
            throw new \Exception("Failed to activate account");
        }
        return true;
    }
}
