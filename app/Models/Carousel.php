<?php

namespace App\Models;

use App\Enums\Carousel\State;
use App\Enums\Carousel\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'product_id',
        'action',
        'state',
        'image',
    ];

    protected $appends = ['image_url'];

    protected $casts = [
        'state' => State::class,
        'type' => Type::class,
    ];

    public function getImageUrlAttribute()
    {
        return isset($this->image) ? asset('storage/' . $this->image) : asset('assets/front/images/defaults/image-default.jpg');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('state', '=', State::ACTIVE);
    }

}
