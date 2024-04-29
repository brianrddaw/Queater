<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class OrdersLine extends Model
{
    protected $fillable = ['id','order_id', 'product_id', 'quantity', 'state'];

    public function order()
    {
        return $this->belongsTo(order::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
