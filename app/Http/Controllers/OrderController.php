<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderEditRequest;
use App\Http\Requests\OrderCreateRequest;
use App\Models\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     *
     */
    public function search(Request $request)
    {
        $query = Order::query();

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
        return view('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderCreateRequest $request): RedirectResponse
    {
        Order::create($request->validated());

        return redirect()->route('orders.index')->with('success', 'Order added successfully.');
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
    public function edit(Order $order): View
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderEditRequest $request, Order $order): RedirectResponse
    {
        $order->update($request->validated());

        return redirect()->route('orders.index')->with('success','Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response('Order deleted successfully');
    }
}
