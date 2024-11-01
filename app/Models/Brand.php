<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'image',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return isset($this->image) ? asset('storage/'.$this->image) : asset('assets/admin/images/default-150x150.png');
    }


//    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(Product::class);
//    }
}
