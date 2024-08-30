<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderItemController extends Controller
{
    /**
     *
     */
    public function search(Request $request)
    {
        $query = OrderItem::query();

        if ($request->filled('column') && $request->filled('search')) {
            $query->where($request->column, 'LIKE', '%' . $request->search . '%');
        }

        $results = $query->paginate(15);

        return response()->json($results);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('order_items.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('order_items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $order = Order::findOrFail($request->order_id);

        if ($product->amount < $request->amount) {
            return back()->withErrors('Not enough product in stock.');
        }

        $price = $product->price;
        $amount = $request->amount;

        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $product->id;
        $orderItem->price = $price;
        $orderItem->amount = $amount;
        $orderItem->save();

        $product->amount -= $amount;
        $product->save();

        $order->price_total += $price * $amount;
        $order->save();

        return redirect()->route('order_items.index')->with('success', 'Order item added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
//    public function edit(OrderItem $order_item): View
//    {
//        return view('order_items.edit', compact('order_item'));
//    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request, OrderItem $order_item)
//    {
//        // Validate the incoming data
//        $request->validate([
//            'order_id' => 'required|exists:orders,id',
//            'product_id' => 'required|exists:products,id',
//            'amount' => 'required|integer|min:1',
//        ]);
//
//        // Find the associated product and orders
//        $product = Product::findOrFail($request->product_id);
//        $oldOrder = Order::findOrFail($order_item->order_id);
//        $newOrder = Order::findOrFail($request->order_id);
//
//        // Calculate the change in amount
//        $amountDifference = $request->amount - $order_item->amount;
//
//        // Adjust the product's amount based on the difference
//        $newProductAmount = $product->amount - $amountDifference;
//
//        // Check if there's enough product in stock
//        if ($newProductAmount < 0) {
//            return back()->withErrors(['amount' => 'Not enough products in stock.']);
//        }
//
//        // Update the product's amount
//        $product->amount = $newProductAmount;
//        $product->save();
//
//        // Update the order item with the new values
//        $order_item->amount = $request->amount;
//        $order_item->order_id = $request->order_id;
//        $order_item->save();
//
//        // Adjust the price_total in the old order (only if the order_id has changed)
//        if ($order_item->wasChanged('order_id')) {
//            $oldOrder->price_total -= $order_item->price * $order_item->amount;
//            $oldOrder->save();
//
//            $newOrder->price_total += $order_item->price * $order_item->amount;
//            $newOrder->save();
//        } else {
//            // Update the price_total for the same order
//            $oldOrder->price_total += $amountDifference * $product->price;
//            $oldOrder->save();
//        }
//
//        return redirect()->route('order_items.index')->with('success', 'Order item updated successfully.');
//    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $product = Product::findOrFail($orderItem->product_id);
        $order = Order::findOrFail($orderItem->order_id);

        $order->price_total -= $orderItem->price * $orderItem->amount;
        $order->save();

        $product->amount += $orderItem->amount;
        $product->save();

        $orderItem->delete();

        return response('Order item deleted successfully');
    }
}
