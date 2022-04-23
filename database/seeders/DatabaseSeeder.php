<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Category;
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
        $category = Category::query()->firstOrCreate(['title' => 'shoes']);
        Category::query()->firstOrCreate(['title' => 'clothes']);
        Category::query()->firstOrCreate(['title' => 'hat']);

        $attribute = Attribute::query()->firstOrcreate(['title' => 'size']);

        $category->attributes()->detach();
        $category->attributes()->attach($attribute->id);

        $attribute->values()->firstOrCreate(['title' => '40']);
        $attribute->values()->firstOrCreate(['title' => '41']);
    }
}
