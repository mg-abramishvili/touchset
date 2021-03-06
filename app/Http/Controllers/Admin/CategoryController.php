<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function item($id)
    {
        return Category::find($id);
    }

    public function index_data()
    {
        return $categories = Category::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;

        if($request->parent_id == 0) {
            $category->parent_id = null;
        } else {
            $category->parent_id = $request->parent_id;
        }

        if (!isset($request->cover)) {
            $category->cover = null;
        } else {
            $category->cover = $request->cover;
        }

        $category->save();
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;

        if($request->parent_id == 0) {
            $category->parent_id = null;
        } else {
            $category->parent_id = $request->parent_id;
        }

        if (!isset($request->cover)) {
            $category->cover = null;
        } else {
            $category->cover = $request->cover;
        }

        $category->save();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->products()->detach();
        $category->delete();
        return redirect()->route('admin_categories');
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
        if (request()->file('cover')) {
            $file = request()->file('cover');

            $filename = md5(time() . rand(1, 100000)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads', $filename);

            return \Response::make('/uploads/' . $filename, 200, [
                'Content-Disposition' => 'inline',
            ]);

        }
    }
}