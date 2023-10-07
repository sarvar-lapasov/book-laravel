<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ["user_id","title", "description", "content", ];


    public function photos():MorphMany
    {
        return $this->morphMany(Photo::class,'photoable');
    }

    public function user():BelongsTo
     {
       return $this->BelongsTo(User::class);
    }
    
    public function comments():HasMany
     {
       return $this->hasMany(Comment::class);
    }
}
