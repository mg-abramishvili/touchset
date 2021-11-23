<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function pages_create()
    {
        return view('admin.pages.create');
    }

    public function pages_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'content' => 'required',
        ]);

        $data = request()->all();
        $page = new Page();
        $page->name = $data['name'];
        $page->slug = $data['slug'];
        $page->content = $data['content'];

        $page->save();

        return redirect()->route('admin_pages');
    }

    public function page_item_edit($id)
    {
        $page = Page::find($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function page_item_update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'content' => 'required',
        ]);

        $page = Page::find($id);
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->content;

        $page->save();

        return redirect()->route('admin_pages');
    }

    public function page_item_delete($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect()->route('admin_pages');
    }
}
