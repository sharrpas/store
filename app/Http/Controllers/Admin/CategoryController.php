<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->select(['id','title'])->get();
        return $this->success($categories);
    }

    public function store(Request $request)
    {
        $validated_data = Validator::make($request->all(), [
            'title' => 'required|min:3|max:30',
        ]);
        if ($validated_data->fails())
            return $this->error(Status::VALIDATION_FAILED,$validated_data->errors());

        Category::query()->create(['title' => $request->title]);

        return $this->success('your category saved successfully');
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
