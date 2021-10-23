<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function category_item($id)
    {
        $category = Category::find($id);
        $products = Product::whereRelation('categories', 'category_id', $id)->get();
        return view('categories.category_item', compact('category', 'products'));
    }
}
