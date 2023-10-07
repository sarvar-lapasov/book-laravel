<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;



class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name', 
        'description',
        'text',
        'price'
    ];

    // public array $translatable= ['name', 'description', 'text'];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
        
    }

    public function photos():MorphMany
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
}
