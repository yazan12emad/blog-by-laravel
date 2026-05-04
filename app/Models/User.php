<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'profile_image', 'password', 'role'];

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
        ];
    }

    public function ideas(): HasMany{
        return $this->hasMany(ideas::class);
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
