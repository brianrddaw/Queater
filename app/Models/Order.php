<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrdersLine;
use App\Models\Table;

class Order extends Model
{
    protected $fillable = ['state','take_away','table_id'];

    public function ordersLine()
    {
        return $this->hasMany(OrdersLine::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

}
