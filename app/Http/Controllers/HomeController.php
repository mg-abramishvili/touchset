<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products_is_new = Product::where('is_new', true)->get();
        $products_is_popular = Product::where('is_popular', true)->get();
        $products_is_onsale = Product::where('is_onsale', true)->get();
        return view('home', compact('products_is_new', 'products_is_popular', 'products_is_onsale'));
    }
}
