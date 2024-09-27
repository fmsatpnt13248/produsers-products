<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Product;

class OrderObserver
{
    /**
     * Handle the Order "deleted" event.
     */
    public function deleting(Order $order): void
    {
        foreach ($order->order_items as $order_item) {
            $product = Product::find($order_item->product_id);
            $product->amount += $order_item->amount;
            $product->save();
        }
    }
}
