<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    protected $fillable = [
        'quantity',
        'price',
        'sku',
    ];

    public function attributevalues(): HasMany{
        return $this->hasMany(AttributeValue::class);
    }
}
