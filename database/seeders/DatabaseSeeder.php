<?php

namespace Database\Seeders;

use App\Models\Attribute;
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

        //attributes
        $attribute = $category->attributes()->firstOrcreate(['title' => 'size']);

        //attribute_values
        $attribute->values()->firstOrCreate(['title' => '40']);
        $v41 =  $attribute->values()->firstOrCreate(['title' => '41']);

        //products
        $product = Product::query()->firstOrCreate(['title' => 'walking shoes', 'inventory' => 4, 'main_image' => '##']);
        $product->price()->firstOrCreate(['price' => '15000']);
        $product->images()->firstOrCreate(['path' => '#########']);

        //category_product
        $product->categories()->detach($category->id);
        $product->categories()->attach($category->id);

        //attribute_values_product
        $product->attribute_values()->detach($v41->id);
        $product->attribute_values()->attach($v41->id);

        //carts
        $user = User::query()->firstOrCreate(['name' => 'admin', 'phone' => '0000'],[ 'password' => Hash::make('123')]);
        $cart = $user->cart()->firstOrCreate(['status' => 0, 'order_code' => '12345200263']);
        $cart->products()->detach($product->id);
        $cart->products()->attach($product->id,['num' => '1']);

        //roles
        $role =Role::query()->firstOrCreate(['title' => 'super_admin']);
        $user->roles()->detach($role->id);
        $user->roles()->attach($role->id);
    }
}
