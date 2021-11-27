<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Addon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order_store(Request $request)
    {
        $orderItemsArray = $request->order_items;

        $order = new Order();
        $order->tel = '987654321';
        $order->email = '1@1.net';
        $order->save();

        for ($orderItemsArrayItem=0; $orderItemsArrayItem < count($orderItemsArray); $orderItemsArrayItem++) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $orderItemsArray[$orderItemsArrayItem]["id"];
            $orderItem->price = $orderItemsArray[$orderItemsArrayItem]["price"];
            $orderItem->save();
            $order->orderItems()->attach($orderItem->id, ['order_id' => $order->id]);

            $addons_array = $orderItemsArray[$orderItemsArrayItem]["addons_array"];
            
            for ($addonItem=0; $addonItem < count($addons_array); $addonItem++) {
                $addon = Addon::find($addons_array[$addonItem]);

                $orderItem->addons()->attach($addon->id, [
                    'price' => $addon->products()->where('product_id', $orderItem->product_id)->first()->pivot->price,
                ]);
            }
        }

        return $order->id;
    }
}
