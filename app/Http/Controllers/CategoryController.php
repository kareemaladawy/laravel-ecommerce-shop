<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $brands = Brand::all();
        return view('site.pages.collection', compact('category', 'brands'));
    }
}
