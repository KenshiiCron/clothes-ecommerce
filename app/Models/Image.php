<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = [
        'path',
        'product_id',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return isset($this->path) ? asset('storage/' . $this->path) : asset('assets/front/images/defaults/image-default.jpg');
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
