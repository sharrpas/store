<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    public function store(Request $request, Category $category)
    {
        $validated_data = Validator::make($request->all(), [
            'attribute' => 'required|min:3|max:30',
            "attribute_values" => "required|array|min:1",
            "attribute_values.*" => "required|distinct",
        ]);
        if ($validated_data->fails())
            return $this->error(Status::VALIDATION_FAILED, $validated_data->errors());

//        dd($request->attribute_values);

//        DB::beginTransaction();
//        try {
            $attribute = $category->attributes()->create(['title' => $request->attribute]);
            $attribute->values()->insert([['title' => 'jaydeep'],['title' => '444444']]);  //TODO   do this has an ERROR
//        } catch (\Exception $exception) {
//            DB::rollBack();
//            return $this->error(null,$exception->getMessage());
//        }
        return $this->success('mmmm');
    }
}
