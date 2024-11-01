<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->image ? asset('storage/'.$this->image) : asset('assets/front/images/category-d-1.jpg');
    }
}
