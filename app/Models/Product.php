<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        "image",
        "title",
        "price",
        "stock",
        "description",
    ];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'carts')->withPivot('quantity'); // Include any extra pivot columns here
    }
}
