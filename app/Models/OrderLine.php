<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'state'];

    // Relación con la tabla orders
    public function order()
    {
        return $this->belongsTo(order::class);
    }

    // Relación con la tabla products
    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
