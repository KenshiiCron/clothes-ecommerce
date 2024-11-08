<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'featured',
        'image',
    ];

    protected $appends = ['image_url'];

    protected $casts = ['featured' => 'boolean'];

    public function getImageUrlAttribute()
    {
        return isset($this->image) ? asset('storage/' . $this->image) : asset('assets/front/images/image-default.jpg');
    }


//    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(Product::class);
//    }
}
