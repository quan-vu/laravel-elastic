<?php

namespace App\Models;

use App\Traits\HasUuid;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuid, Sluggable;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'thumbnail',
        'description',
        'content',
        'category_id',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
