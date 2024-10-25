<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'address',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}