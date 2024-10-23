<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = [
        'name',
    ];

    public function sizes()
    {
        return $this->hasMany(PizzaSize::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'pizza_ingredient');
    }

    public function rawMaterials()
    {
        return $this->belongsToMany(RawMaterial::class, 'pizza_raw_material');
    }
}

