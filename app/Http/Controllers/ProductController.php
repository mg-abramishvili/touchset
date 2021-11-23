<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Addon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_item($id)
    {
        $product = Product::with('attributes', 'addons')->find($id);
        $addons = Addon::with('products')->get();
        $other_products = Product::whereRelation('categories', 'category_id', $product->categories->first()->id)->get();
        $products_is_new = Product::where('is_new', true)->get();
        return view('products.product_item', compact('product', 'addons', 'other_products', 'products_is_new'));
    }

    public function product_search(Request $request)
    {
        $products = Product::where('name', 'like', "%{$request->search}%")->get();
        return view('search.index', compact('products'));
    }
}
