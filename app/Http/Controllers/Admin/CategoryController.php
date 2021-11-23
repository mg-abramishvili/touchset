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

        $data = request()->all();
        $category = new Category();
        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->parent_id = $data['parent_id'];

        $category->save();

        return redirect()->route('admin_categories');
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
        $category->parent_id = $request->parent_id;

        $category->save();

        return redirect()->route('admin_categories');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->products()->detach();
        $category->delete();
        return redirect()->route('admin_categories');
    }
}