<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'featured',
        'image',
        'order'
    ];

    protected $appends = ['image_url'];

    protected $casts = ['featured' => 'boolean'];

    public function getImageUrlAttribute()
    {
        return isset($this->image) ? asset('storage/'.$this->image) : asset('assets/front/images/defaults/image-default.jpg');
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('featured', '=', true);
    }


    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
}
