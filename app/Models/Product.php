<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\OrdersLine;
use App\Models\ProductCategory;
use App\Models\Allergen;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'availability','category_id', 'image_url'];

    // Relación con la tabla linea_pedido
    public function lineasPedido()
    {
        return $this->hasMany(OrdersLine::class);
    }

    // Relación con la tabla category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación con la tabla products_allergens
    public function allergens()
    {
        return $this->belongsToMany(Allergen::class);
    }
}

