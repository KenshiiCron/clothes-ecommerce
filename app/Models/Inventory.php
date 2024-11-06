<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    protected $fillable = [
        'quantity',
        'price',
        'old_price',
        'sku',
    ];

    public function attribute_values(): HasMany{
        return $this->hasMany(AttributeValue::class);
    }
}
