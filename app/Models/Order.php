<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['state'];

    public function ordersLine()
    {
        return $this->hasMany(OrdersLine::class);
    }
}
