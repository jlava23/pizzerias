<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraIngredient extends Model
{
    protected $fillable = [
        'name',
        'price',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_extra_ingredient');
    }
}
