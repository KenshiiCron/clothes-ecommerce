<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'name', 'slug', 'description','category_id','image'
    ];

    protected $appends = ['image_url'];

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function getImageUrlAttribute()
    {
        return isset($this->image) ? asset('storage/'.$this->image) : asset('assets/front/images/image-default.jpg');
    }
}
