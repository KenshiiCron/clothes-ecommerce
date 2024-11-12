<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_number',
        'name',
        'address',
        'phone',
        'email',
        'total_price',
        'sub_total_price',
        'shipping_price',
        'discount',
        'state',
        'wilaya_id',
        'commune_id',
        'delivery_state',
        'payment_method',
        'payment_state',
        'tracking',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function orderItems()
    {
        return $this->belongsToMany(Product::class,'order_items',)->withPivot('qty','total','attributes')->withTimestamps();
    }
}
