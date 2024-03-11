<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAllergens extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'allergen_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function allergen()
    {
        return $this->belongsTo(Allergen::class);
    }

}
