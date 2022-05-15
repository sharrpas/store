<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        $attribute = Attribute::query()->firstOrcreate(['title' => 'size']);

        //attribute_categories
        $category->attributes()->detach();
        $category->attributes()->attach($attribute->id);

        //attribute_values
        $attribute->values()->firstOrCreate(['title' => '40']);
        $v41 =  $attribute->values()->firstOrCreate(['title' => '41']);

        //products
        $product = Product::query()->firstOrCreate(['title' => 'walking shoes', 'inventory' => 4, 'main_image' => '##']);
        $product->price()->firstOrCreate(['price' => '15000']);
        $product->images()->firstOrCreate(['path' => '#########']);

        //category_product
        $product->categories()->detach();
        $product->categories()->attach($category->id);

        //attribute_values_product
        $product->attribute_values()->detach();
        $product->attribute_values()->attach($v41->id);

        //carts
        $user = User::query()->firstOrCreate(['name' => 'test', 'phone' => '0000', 'password' => '123']);
        $user->cart()->firstOrCreate(['status' => 0, 'order_code' => '12345200263']);

    }
}
