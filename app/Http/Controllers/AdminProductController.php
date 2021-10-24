<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function products_create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function products_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $data = request()->all();
        $product = new Product();
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];

        $product->save();

        $product->categories()->attach($data['category'], ['product_id' => $product->id]);

        return redirect()->route('admin_products');
    }

    public function product_item_edit($id)
    {
        $product = Product::with('attributes')->find($id);
        $categories = Category::all();
        $attributes = Attribute::all();
        return view('admin.products.edit', compact('product', 'categories', 'attributes'));
    }

    public function product_item_update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if($request->is_new) {
            $product->is_new = true;
        } else {
            $product->is_new = false;
        }
        
        if($request->is_popular) {
            $product->is_popular = true;
        } else {
            $product->is_popular = false;
        }

        if($request->is_onsale) {
            $product->is_onsale = true;
        } else {
            $product->is_onsale = false;
        }

        $product->save();

        $product->categories()->detach();
        $product->categories()->attach($request->category, ['product_id' => $product->id]);

        $attributes = $request->attribute;
        
        foreach($attributes as $key => $value) {
            if($value != null) {
                $product->attributes()->detach($key);
                $product->attributes()->attach(
                    [$key => [
                        'attribute_id'=>$key,
                        'product_id'=>$product->id,
                        'value'=>$value,
                    ]
                ]);
            } else {
                $product->attributes()->detach($key);
            }
        }

        return redirect()->route('admin_products');
    }
}
