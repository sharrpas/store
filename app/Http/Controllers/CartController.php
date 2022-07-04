<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return $this->success(CartResource::make($user->cart()->first()));
    }

    public function store(Product $product, Request $request)
    {
        $validated_data = Validator::make($request->all(), ['attributes' => 'required|array',]);
        if ($validated_data->fails())
            return $this->error(Status::VALIDATION_FAILED, $validated_data->errors());

        $user = auth()->user();
        $cart = $user->cart()->firstOrCreate(['status' => 0]);
        $cart->products()->detach($product->id);
        $cart->products()->attach($product->id, ['quantity' => '1','attributes' => json_encode($request->toArray()['attributes'])]);
        return $this->success('added to your cart');
    }

    public function destroy()
    {
        // delete one product in cart
    }


    //TODO OrderController for finalize order and remove from cart
}
