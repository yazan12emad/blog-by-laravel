<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;


class ProfileController extends Controller
{
    public function showProfile(User $user)
    {
        if(auth()->id() !== $user->id) {
            abort(403);
        }

        return view('profile.show', [
            'user' => $user,
        ]);
    }


public function update(UpdateProfileRequest $request , User $user , ProfileService $profileService) : RedirectResponse
{
    $data = $request->validated();

    if (auth()->id() !== $user->id){
        abort(403);
    }

    if ($request->hasFile('profile_image')) {
        try {
            $data['profile_image'] = $profileService->handleImageUpload($request->file('profile_image'), $user->profile_image);
        }
        catch (\Exception $e) {
            return back()->withErrors(['profile_image' => $e->getMessage()]);
        }
    }

    if (empty($data['password'])) {
        unset($data['password']);
    }

    try {
        $wasChanged = $profileService->updateProfile($user, $data);
    } catch (\Exception $e) {
        return back()->withErrors(['Failed' => $e->getMessage()]);
    }

    if (!$wasChanged) {
        return back()->with('Pending', 'No changes were made.');
    }

        return back()->with('Success', 'Profile updated successfully!');
}


}
