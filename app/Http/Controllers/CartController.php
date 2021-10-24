<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        return view('cart.index');
    }

    public function cart_data()
    {
        return session()->get('cart');
    }

    public function add($id)
    {
        $product = Product::find($id);

        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $cart[$id]['price_total'] = $cart[$id]['quantity'] * $cart[$id]['price'];
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "price_total" => $product->price,
            ];
        }
          
        session()->put('cart', $cart);
        //dd(session()->get('cart'));
        return redirect()->route('cart');
    }

    public function update($id, $quantity, Request $request)
    {
        if($id && $quantity){
            $cart = session()->get('cart');
            $cart[$id]["quantity"] = $quantity;
            $cart[$id]["price_total"] = $quantity * $cart[$id]["price"];
            session()->put('cart', $cart);
        }
    }

    public function remove($id, Request $request)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
    }
}
