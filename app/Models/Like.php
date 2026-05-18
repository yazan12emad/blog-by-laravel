<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    Protected $fillable = ['blog_id', 'user_id'];

    public function blog(){
        return $this->belongsTo(Blog::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
