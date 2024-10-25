<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PizzaRawMaterial extends Model
{
    protected $fillable = [
        'pizza_id',
        'raw_material_id',
        'quantity',
    ];
}
