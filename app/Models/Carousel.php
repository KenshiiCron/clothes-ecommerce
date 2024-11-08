<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $fillable = [
        'name',
        'description',
        'product_id',
        'action',
        'state',
        'image',
    ];

    protected $appends = ['image_url'];

    protected $casts = [
        'state' => 'boolean'
    ];

    public function getImageUrlAttribute()
    {
        return isset($this->image) ? asset('storage/' . $this->image) : asset('assets/front/images/image-default.jpg');
    }
}
