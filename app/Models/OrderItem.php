<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'product_id',
        'order_id',
        'total',
        'qty',
        'attributes',
    ];

    protected $casts=[
        'attributes'=>'array',
        'total'=>'double',
    ];

//    public function order()
//    {
//        return $this ->belongsTo(Orders::class);
//    }
//    public function product(){
//        return $this ->belongsTo(Product::class);
//    }
}
