<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ["post_id", "user_id", "parent_id" ,"body", "status"];



    public function post():BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function childComments():HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parentComment()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
}
