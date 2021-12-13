<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::with('children')->get();
        return view('admin.products.create', compact('categories'));
    }
    
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }

    public function item($id)
    {
        return $product = Product::with('attributes', 'categories', 'addons')->find($id);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->pre_rub = $request->pre_rub;
        $product->pre_usd = $request->pre_usd;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;

        if (!isset($request->gallery)) {
            $request->gallery = [];
        }
        $product->gallery = $request->gallery;

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
        $product->categories()->attach($request->category, ['product_id' => $product->id]);

        foreach($request->attribute as $attr) {
            if($attr["value"] != null) {
                $product->attributes()->detach($attr["id"]);
                $product->attributes()->attach(
                    [$attr["id"] => [
                        'attribute_id'=>$attr["id"],
                        'product_id'=>$product->id,
                        'value'=>$attr["value"],
                    ]
                ]);
            } else {
                $product->attributes()->detach($attr["id"]);
            }
        }
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->pre_rub = $request->pre_rub;
        $product->pre_usd = $request->pre_usd;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;

        if (!isset($request->gallery)) {
            $request->gallery = [];
        }
        $product->gallery = $request->gallery;

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

        foreach($request->attribute as $attr) {
            if($attr["value"] != null) {
                $product->attributes()->detach($attr["id"]);
                $product->attributes()->attach(
                    [$attr["id"] => [
                        'attribute_id'=>$attr["id"],
                        'product_id'=>$product->id,
                        'value'=>$attr["value"],
                    ]
                ]);
            } else {
                $product->attributes()->detach($attr["id"]);
            }
        }
    }

    public function file($type)
    {
        switch ($type) {
            case 'upload':
                return $this->upload();
        }
        return \Response::make('success', 200, [
            'Content-Disposition' => 'inline',
        ]);
    }

    public function upload()
    {
        if (request()->file('gallery')) {
            $file1 = request()->file('gallery');
            for ($i = 0; $i < count($file1); $i++) {

                $file = $file1[$i];
                $filename = md5(time() . rand(1, 100000)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads', $filename);

                return \Response::make('/uploads/' . $filename, 200, [
                    'Content-Disposition' => 'inline',
                ]);
            }
        }
    }
}
