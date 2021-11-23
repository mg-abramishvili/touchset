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
            $addons_array = $request->addons;
            $addons = Addon::with(
                [
                    'products' => function ($query) use ($id) {
                        $query->where('product_id');
                        $query->orWhere('product_id', $id);
                    },
                ]
            )
            ->where(function ($q) use ($addons_array) {
                $q->where('id');
                foreach($addons_array as $addon) {
                    $q->orWhere('id', $addon);
                }
            })
            ->get();
            $addons_price = 0;
            foreach($addons as $addon)
            {
                $addons_price += $addon->products->first()->pivot->price;
            }
            $sku = $id; 
            foreach($addons as $addon) {
                $sku .= '_' . $addon->slug;
            }
        } else {
            $addons_array = [];
            $addons = [];
            $addons_price = 0;
            $sku = $id;
        }

        $addons_all = Addon::with(
            [
                'products' => function ($query) use ($id) {
                    $query->where('product_id');
                    $query->orWhere('product_id', $id);
                },
            ]
        )
        ->whereRelation('products', 'product_id', $id)
        ->get();

        $product = Product::find($id);

        $cart = session()->get('cart', []);
  
        if(isset($cart[$sku])) {
            $cart[$sku]['quantity']++;
            $cart[$sku]['price_total'] = $cart[$sku]['quantity'] * $cart[$sku]['price'];
        } else {
            $cart[$sku] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "addons" => $addons,
                "price" => $product->price + $addons_price,
                "price_total" => $product->price + $addons_price,
                "sku" => $sku,
                "addons_all" => $addons_all,
                "addons_array" => $addons_array,
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
