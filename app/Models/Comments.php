<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $fillable = ['comment_body', 'blog_id', 'user_id'];


    public function blog(){
        return $this->belongsTo(Blog::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
