<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function categories_create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function categories_store(Request $request)
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

    public function category_item_edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function category_item_update($id, Request $request)
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

    public function category_item_delete($id)
    {
        $category = Category::find($id);
        $category->products()->detach();
        $category->delete();
        return redirect()->route('admin_categories');
    }
}