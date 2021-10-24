<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page_item($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('pages.page_item', compact('page'));
    }
}
