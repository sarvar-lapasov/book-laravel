<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\ProductResource;



class CategoryProductController extends Controller
{
    public function index(Category $category)
    {
        return ProductResource::collection($category->products()->latest()->paginate(6));
    }
}
