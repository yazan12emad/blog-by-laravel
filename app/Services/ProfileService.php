<?php

namespace App\Services;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ProfileService
{
    public function updateProfile(User $user, array $data): bool{

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

          if(!$user->update($data)){
              throw new \Exception('Failed to update profile');
          }

        return $user->wasChanged();
      }

    public function handleImageUpload(UploadedFile $newImage, ?string $oldImagePath): string
    {
        if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
            Storage::disk('public')->delete($oldImagePath);
        }

        // Store and return new image path
        return $newImage->store('user_uploaded_profile_image', 'public');
    }



}
