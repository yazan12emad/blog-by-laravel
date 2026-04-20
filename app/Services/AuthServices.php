<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class AuthServices
{
    public function logIn(array $userData): User
  {
      $user = User::where('email', $userData['email'])->first();
        if (!$user) {
          throw new \Exception("email not found");
      }
      if ( !Hash::check($userData['password'], $user->password)) {
          throw new \Exception("The password not correct ");
      }
      return $user;

  }

    public function registerUser($Data){
        return  User::create([
            'name' => $Data['name'],
            'email' => $Data['email'],
            'password' => Hash::make($Data['password']),
        ]);

    }

     public function logOut (Request $request): void
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

    }


}
