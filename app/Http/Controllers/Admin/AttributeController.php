<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function index_data()
    {
        return $attributes = Attribute::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'order' => 'required',
        ]);

        $data = request()->all();
        $attribute = new Attribute();
        $attribute->name = $data['name'];
        $attribute->slug = $data['slug'];
        $attribute->order = $data['order'];

        $attribute->save();

        return redirect()->route('admin_attributes');
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'order' => 'required',
        ]);

        $attribute = Attribute::find($id);
        $attribute->name = $request->name;
        $attribute->slug = $request->slug;
        $attribute->order = $request->order;

        $attribute->save();

        return redirect()->route('admin_attributes');
    }

    public function delete($id)
    {
        $attribute = Attribute::find($id);
        $attribute->products()->detach();
        $attribute->delete();
        return redirect()->route('admin_attributes');
    }
}