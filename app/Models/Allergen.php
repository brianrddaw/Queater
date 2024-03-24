<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'img_url'];

    public function productAllergens()
    {
        return $this->hasMany(ProductAllergen::class);
    }

}
