<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function price()
    {
        return $this->hasOne(PriceProduct::class);
    }

    public function images()
    {
        return $this->hasMany(ImageProduct::class);
    }

    public function attribute_values()
    {
        return $this->belongsToMany(AttributeValue::class);
    }
}
