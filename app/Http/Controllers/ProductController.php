<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_item($id)
    {
        $product = Product::find($id);
        return view('products.product_item', compact('product'));
    }

    public function product_search(Request $request)
    {
        $products = Product::where('name', 'like', "%{$request->search}%")->get();
        return view('search.index', compact('products'));
    }
}
