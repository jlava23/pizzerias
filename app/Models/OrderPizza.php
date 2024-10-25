<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPizza extends Model
{
    protected $fillable = [
        'order_id',
        'pizza_size_id',
        'quantity',
    ];
}
