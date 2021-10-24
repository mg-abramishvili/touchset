<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function product_item_edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function product_item_update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $data = request()->all();
        $product = Product::find($id);
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];

        $product->save();

        $product->categories()->detach();
        $product->categories()->attach($data['category'], ['product_id' => $product->id]);

        return redirect()->route('admin_products');
    }
}
