<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        $user = auth()->user();
       return $this->success(CartResource::make($user->cart()->first()));
    }

    public function store(Product $product)
    {
        $user = auth()->user();
        $cart = $user->cart()->firstOrCreate([
            'status' => 0,
            'order_code' => 'DoNotNeed'
        ]);
        $cart->products()->detach($product->id);
        $cart->products()->attach($product->id, ['num' => '1']);
        return $this->success('added to your cart');
    }

    public function destroy()
    {
        // delete one product in cart
    }


    //TODO OrderController for finalize order and remove from cart
}
