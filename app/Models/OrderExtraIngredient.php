<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderExtraIngredient extends Model
{
    protected $fillable = [
        'order_id',
        'extra_ingredient_id',
        'quantity',
    ];
}
