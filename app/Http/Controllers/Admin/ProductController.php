<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Category $category)
    {
        return $this->success(new ProductCollection($category->products()->paginate(10)));
    }

    public function show(Product $product)
    {
        return $this->success(ProductResource::make($product->load(['images'])));
    }

    public function store(Category $category, Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'title' => 'required',
            'inventory' => 'required|numeric',
            'price' => 'required',
            'main_image' => 'required|image',
            'images' => 'required|array',
            'images.*' => 'image',
            'attributes' => 'required|array',
        ]);
        if ($validated_data->fails())
            return $this->error(Status::VALIDATION_FAILED, $validated_data->errors());


        DB::beginTransaction();
        try {
            $imageName = date('Ymdhis') . rand(100, 999) . '.' . $request->file('main_image')->extension();
            $product = Product::query()->Create([
                'title' => $request->title,
                'inventory' => $request->inventory,
                'attributes' => json_encode($request->toArray()['attributes']),
                'main_image' => $imageName,
            ]);
            $product->price()->Create(['price' => $request->price]);

            Storage::putFileAs('images', $request->file('main_image'), $imageName);

            foreach ($request->file('images') as $image) {
                $imagesName = date('Ymdhis') . rand(100, 999) . '.' . $image->extension();
                Storage::putFileAs('images', $image, $imagesName);
                $product->images()->Create(['path' => $imagesName]);
            }

            $product->categories()->attach($category->id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->error(Status::OTHER_EXCEPTION_THROWN,$exception->getMessage());
        }

        return $this->success('product saved');

    }
}
