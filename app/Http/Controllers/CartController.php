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

    public function checkout()
    {
        return view('cart.checkout');
    }

    public function cart_data()
    {
        return session()->get('cart');
    }

    public function add($id, Request $request)
    {
        $product = Product::with('addons')->where('id', $id)->first();
        $product_addons = $product->addons;

        if($request->addons) {
            $addons_selected_IDs = $request->addons;
            $addons_selected = $product_addons->whereIn('id', $addons_selected_IDs)->values()->all();
            $sku = $id; 
            foreach($product->addons as $addon) {
                foreach($addons_selected as $addon_selected) {
                    if($addon->id == $addon_selected->id) {
                        $sku .= '_' . $addon->slug;
                    }
                }
            }
        } else {
            $addons_selected = null;
            $sku = $id;
        }

        $cart = session()->get('cart', []);
  
        if(isset($cart[$sku])) {
            $cart[$sku]['quantity']++;
        } else {
            $cart[$sku] = [
                "sku" => $sku,
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "addons" => $product_addons,
                "addons_selected" => $addons_selected,
                "price" => $product->price,
            ];
        }
          
        session()->put('cart', $cart);
        //dd(session()->get('cart'));
        return redirect()->route('cart');
    }

    public function update_cart(Request $request)
    {
        $cart = $request->cart;
        session()->put('cart', $cart);
    }

    public function update_cart_item_quantity($sku, $quantity, Request $request)
    {
        if($sku && $quantity){
            $cart = session()->get('cart');
            $cart[$sku]["quantity"] = $quantity;
            $cart[$sku]["price_total"] = $quantity * $cart[$sku]["price"];
            session()->put('cart', $cart);
        }
    }

    public function remove($sku, Request $request)
    {
        if($sku) {
            $cart = session()->get('cart');
            if(isset($cart[$sku])) {
                unset($cart[$sku]);
                session()->put('cart', $cart);
            }
        }
    }
}
