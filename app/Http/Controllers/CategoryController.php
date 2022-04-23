<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->select(['id','title'])->get();
        return $this->success($categories);
    }
}
