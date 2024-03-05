<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'availability'];

    // Relación con la tabla linea_pedido
    public function lineasPedido()
    {
        return $this->hasMany(LineaPedido::class);
    }
}