<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'old_price',
        'sku',
    ];

    public function attribute_values(): BelongsToMany{
        return $this->belongsToMany(AttributeValue::class);
    }

    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
}
