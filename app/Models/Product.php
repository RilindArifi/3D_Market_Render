<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'category_sub_id',
        'name',
        'link'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function category_sub()
    {
        return $this->belongsTo(CategorySub::class);
    }
}
