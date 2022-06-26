<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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
        //todo ooooooooooooooo
        $validated_data = Validator::make($request->all(), [
            'attributes' => 'required|array',
        ]);
        if ($validated_data->fails())
            return $this->error(Status::VALIDATION_FAILED,$validated_data->errors());

//        $d = json_encode([
//            'color' => ['1','2','3'],
//            'size' => ['01','20','30'],
//            'test' => ['0 1','2 0','3 0'],
//        ]);
//        return $this->success($request->attributes);
    }
}
