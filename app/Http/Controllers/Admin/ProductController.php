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
        return $product = Product::with('attributes', 'categories')->find($id);
    }

    public function store(Request $request)
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

        if (!isset($data['gallery'])) {
            $data['gallery'] = [];
        }
        $product->gallery = $data['gallery'];

        $product->save();

        $product->categories()->attach($data['category'], ['product_id' => $product->id]);

        return redirect()->route('admin_products');
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

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