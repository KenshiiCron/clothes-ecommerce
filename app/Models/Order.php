<?php

namespace App\Models;

use App\Enums\Order\State;
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

    protected $casts=[
        'state'=>State::class,
        'created_at'=>'datetime:l d-m-Y H:i',
        'updated_at'=>'datetime:l d-M-Y H:i',

    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function orderItems()
    {
        return $this->belongsToMany(Inventory::class,'order_items',)->withPivot('qty','total')->withTimestamps();
    }



}
