<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PizzaIngredient extends Model
{
    protected $fillable = [
        'pizza_id',
        'ingredient_id',
    ];
}

