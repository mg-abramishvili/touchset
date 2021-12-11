<?php

namespace App\Http\Controllers\Admin;

use App\Models\Addon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    public function index()
    {
        $addons = Addon::all();
        return view('admin.addons.index', compact('addons'));
    }

    public function create()
    {
        return view('admin.addons.create');
    }

    public function edit($id)
    {
        $addon = Addon::find($id);
        return view('admin.addons.edit', compact('addon'));
    }

    public function index_data()
    {
        return $addons = Addon::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'order' => 'required',
        ]);

        $data = request()->all();
        $addon = new Addon();
        $addon->name = $data['name'];
        $addon->slug = $data['slug'];
        $addon->order = $data['order'];

        $addon->save();

        return redirect()->route('admin_addons');
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'order' => 'required',
        ]);

        $addon = Addon::find($id);
        $addon->name = $request->name;
        $addon->slug = $request->slug;
        $addon->order = $request->order;

        $addon->save();

        return redirect()->route('admin_addons');
    }

    public function delete($id)
    {
        $addon = Addon::find($id);
        $addon->products()->detach();
        $addon->delete();
        return redirect()->route('admin_addons');
    }
}