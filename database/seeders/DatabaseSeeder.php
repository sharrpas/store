<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //categories
        $category = Category::query()->firstOrCreate(['title' => 'shoes']);
        Category::query()->firstOrCreate(['title' => 'clothes']);
        Category::query()->firstOrCreate(['title' => 'hat']);

        //products
        $product = Product::query()->firstOrCreate([
            'title' => 'walking shoes',],[ 'inventory' => 4,'main_image' => '####', 'attributes' => '{ "color": ["red"] }']);
        $product->price()->firstOrCreate(['price' => '15000']);
        $product->images()->firstOrCreate(['path' => '#########']);

        //category_product
        $product->categories()->detach($category->id);
        $product->categories()->attach($category->id);

        //carts
        $user = User::query()->firstOrCreate(['name' => 'admin', 'phone' => '0000'],[ 'password' => Hash::make('123')]);
        $cart = $user->cart()->firstOrCreate(['status' => 0]);
        $cart->products()->detach($product->id);
        $cart->products()->attach($product->id,['quantity' => '1', 'attributes' => '{ "color": ["red"] }']);

        //roles
        $role =Role::query()->firstOrCreate(['title' => 'super_admin']);
        $user->roles()->detach($role->id);
        $user->roles()->attach($role->id);
    }
}
