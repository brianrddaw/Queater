<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['estado'];

    // Relación con la tabla linea_pedido
    public function orderLine()
    {
        return $this->hasMany(OrderLine::class);
    }
}
