<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AdminAttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return view('admin.attributes.index', compact('attributes'));
    }

    public function attributes_create()
    {
        return view('admin.attributes.create');
    }

    public function attributes_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);

        $data = request()->all();
        $attribute = new Attribute();
        $attribute->name = $data['name'];
        $attribute->slug = $data['slug'];

        $attribute->save();

        return redirect()->route('admin_attributes');
    }

    public function attribute_item_edit($id)
    {
        $attribute = Attribute::find($id);
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function attribute_item_update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);

        $attribute = Attribute::find($id);
        $attribute->name = $request->name;
        $attribute->slug = $request->slug;

        $attribute->save();

        return redirect()->route('admin_attributes');
    }
}