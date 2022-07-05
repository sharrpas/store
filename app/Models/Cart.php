<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class,'cart_product');
    }

    public function cart_items()
    {
        return $this->hasMany(CartItems::class);
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }
}
