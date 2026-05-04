<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $primaryKey = 'id';

    protected $fillable = [
        'author_id','title','body','category_id','status','image'
    ];

public function author(){
    return $this->belongsTo(User::class, 'author_id');
}

    public function Category(){
        return $this->belongsTo(Category::class, 'category_id');
    }


}
