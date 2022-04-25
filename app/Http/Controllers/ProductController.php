<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Category $category)
    {
        return $this->success(new ProductCollection($category->products()->paginate(10)));
    }

    public function show(Product $product)
    {
        return $this->success(ProductResource::make($product->load(['images','attribute_values'])));
    }
}
