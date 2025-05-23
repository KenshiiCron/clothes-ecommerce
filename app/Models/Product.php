<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    public $timestamps = true;


    protected $fillable = [
        'name', 'slug', 'description','category_id','image'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'limited' => 'boolean',
        'active' => 'boolean'
    ];

    protected $appends = ['image_url'];

    // Appends

    public function getImageUrlAttribute()
    {
        return isset($this->image) ? asset('storage/'.$this->image) : asset('assets/front/images/defaults/image-default.jpg');
    }

    // Scopes
    public function scopeFeatured(Builder $query): void
    {
        $query->where('featured', '=', true);
    }

    public function scopeLimited(Builder $query): void
    {
        $query->where('limited', '=', true);
    }
    public function scopeHasInventories(Builder $query): void
    {
        $query->whereHas('inventories');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('state', '=', true);
    }
    public function scopeHasValidInventories(Builder $query): void
    {
        $query->whereHas('inventories', function (Builder $query) {
            $query->where('quantity', '>', 0);
        });
    }


    // Relations
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function scopeSizes(): Collection
    {
        return $this->inventories
            ->flatMap(fn ($inventory) => $inventory->attribute_values)
            ->filter(fn ($value) => strtolower(optional($value->attribute)->name) === 'size')
            ->unique('id')
            ->values();
    }

    public function scopeColors(): Collection
    {
        return $this->inventories
            ->flatMap(fn ($inventory) => $inventory->attribute_values)
            ->filter(fn ($value) => strtolower(optional($value->attribute)->name) === 'color')
            ->unique('id')
            ->values();
    }


}
