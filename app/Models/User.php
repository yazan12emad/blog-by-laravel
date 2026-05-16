<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;



class User extends Authenticatable implements MustVerifyEmail
{
    protected $fillable =
        ['name', 'email', 'profile_image', 'password', 'role', 'is_active', 'email_verified_at'];

    Protected $hidden = ['password'];

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active'=> 'boolean',
        ];
    }

    public function isAdmin(): bool{
        return $this->role =='admin';
    }

        public function getRoleAttribute(): string{
            return $this->attributes['role'];

    }

   public function getProfileImageURLAttribute(): string
   {
        if($this-> profile_image){
            return Storage::url($this-> profile_image);
        }
        return Storage::url('user_uploaded_profile_image/default_user_profile_image.png');

   }
}
