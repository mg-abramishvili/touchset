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

            $addons_selected = $orderItemsArray[$orderItemsArrayItem]["addons_selected"];
            
            for ($addonItem=0; $addonItem < count($addons_selected); $addonItem++) {
                $orderItem->addons()->attach($addons_selected[$addonItem]["id"], [
                    'price' => $addons_selected[$addonItem]["pivot"]["price"],
                ]);
            }
        }

        return $order->id;
    }
}
