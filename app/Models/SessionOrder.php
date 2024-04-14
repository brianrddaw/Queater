<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionOrder extends Model
{
    protected $fillable = ['order_id', 'product_id'];

    public function order()
    {
        return $this->belongsTo(order::class);
    }

    public function product()
    {
        return $this->belongsTo(session::class);
    }
}
