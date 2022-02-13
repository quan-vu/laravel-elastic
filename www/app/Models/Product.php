<?php

namespace App\Models;

use App\Traits\HasUuid;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Product extends Model
{
    use HasFactory, HasUuid, Sluggable, ElasticquentTrait;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'thumbnail',
        'description',
        'content',
        'category_id',
    ];

    protected ?array $mappingProperties = array(
        'title' => [
            'type' => 'text',
            'analyzer' => 'standard',   // Auto split word by space
        ],
        'content' => [
            'type' => 'text',
            'analyzer' => 'standard',   // Auto split word by space
        ],
    );

    function getIndexName()
    {
        return 'product_index';
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
