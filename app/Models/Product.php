<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrdersLine;
use App\Models\Allergen;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'availability','category_id', 'image_url'];

    public function lineasPedido()
    {
        return $this->hasMany(OrdersLine::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function allergens()
    {
        return $this->belongsToMany(Allergen::class);
    }
}

