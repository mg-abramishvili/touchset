<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Addon;
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

    public function add($id, Request $request)
    {
        if($request->addons) {
            $addons = $request->addons;
            $addons = Addon::with('products')->where(function ($query) use ($addons) {
                $query->where('id');
                foreach ($addons as $addon) {
                    $query->orWhere('id', $addon);
                }
            })
            ->get();
            $sku = $id . '_1';
        } else {
            $addons = [];
            $sku = $id;
        }

        $product = Product::find($id);

        $cart = session()->get('cart', []);
  
        if(isset($cart[$sku])) {
            if(isset($cart[$sku]['addons'])) {
                $cart[$sku] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "addons" => $addons,
                    "price" => $product->price,
                    "price_total" => $product->price,
                ];
            } else {
                $cart[$sku]['quantity']++;
                $cart[$sku]['price_total'] = $cart[$sku]['quantity'] * $cart[$sku]['price'];
            }
        } else {
            $cart[$sku] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "addons" => $addons,
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
