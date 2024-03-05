<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['state'];

    // Relación con la tabla linea_pedido
    public function orderLine()
    {
        return $this->hasMany(OrderLine::class);
    }
}