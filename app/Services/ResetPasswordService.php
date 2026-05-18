<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordService
{
    public function handleResetPasswordMessage(Request $request): void
    {
        try {
            $userEmail = $request->email;
            $user = User::where('email', $userEmail)->first();
            if (!$user) {
                throw new \Exception('User not found');
            }
            $code = $this->generateResetToken();
            $this->saveCodeInDatabase($code, $userEmail);
            $this->sendResetPasswordMessage($user, $code);
        } catch (\Exception $exception) {
            throw new \Exception('Failed to send reset password code: ' . $exception->getMessage());
        }
    }

    public function generateResetToken(): string
    {
        try {
            return (string)random_int(100000, 999999);
        } catch (\Exception $exception) {
            throw new \Exception('Error in create reset token');
        }
    }

    private function saveCodeInDatabase(string $generateResetToken, string $email): void
    {
        DB::table('password_reset_tokens')
            ->where('email', $email)
            ->delete();

        if (!DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => Hash::make($generateResetToken),
            'created_at' => now(),
        ])) {
            throw new \Exception ('Failed to save reset token');
        }
    }

    public function sendResetPasswordMessage(User $user, $code): void
    {
        $user->notify(new ResetPasswordNotification($code));
    }

    public function handleChangePassword(Request $request): void
    {
        $token = $request->token;
        $email = $request->email;

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$record) {
            throw new \Exception('Invalid or expired reset code');
        }

        $createdAt = Carbon::parse($record->created_at);
        if (Carbon::now()->diffInMinutes($createdAt) > config('auth.passwords.users.expire', 60)) {
            DB::table('password_reset_tokens')
                ->where('email', $email)
                ->delete();

            throw new \Exception('Invalid or expired reset code');
        }

        if (!Hash::check($token, $record->token)) {
            throw new \Exception('Invalid or expired reset code');
        }

        if (User::where('email', $email)->update(['password' => Hash::make($request->password)])) {
            DB::table('password_reset_tokens')
                ->where('email', $email)
                ->delete();
        } else {
            throw new \Exception('Failed to update password');
        }

    }
}
