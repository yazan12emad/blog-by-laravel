<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $primaryKey = 'id';

    protected $fillable = [
        'author_id', 'title', 'body', 'category_id', 'status', 'image', 'short_desc'
    ];

    public function isOwnedBy(User $user): bool
    {
        return $this->author_id === $user->id;
    }
    public function author():belongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function Category():belongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function likes():hasMany
    {
        return $this->hasMany(Like::class);
    }

    public function comments():hasMany
    {
        return $this->hasMany(Comments::Class);
    }

    public function getIsLikedAttribute(){
        return $this->likes()->where('user_id', auth()->id())->exists()?? false;
    }


}
