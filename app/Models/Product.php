<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'image',
    ];

    protected $appends = ['image_url'];

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class);
    }

    public function getImageUrlAttribute()
    {
        return isset($this->image) ? asset('storage/'.$this->image) : asset('assets/admin/images/default-150x150.png');
    }
}
