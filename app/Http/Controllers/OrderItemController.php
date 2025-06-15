<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the order items for a specific order.
     */
    public function index($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);
        return view('admin.order.items.index', compact('order'));
    }

    /**
     * Show the form for creating a new order item.
     */
    public function create($orderId)
    {
        $order = Order::findOrFail($orderId);
        $products = Product::all();
        return view('admin.order.items.create', compact('order', 'products'));
    }

    /**
     * Store a newly created order item in storage.
     */
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        OrderItem::create([
            'order_id' => $orderId,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('admin.order.items.index', $orderId)->with('message', 'Item added to order.');
    }

    /**
     * Show the form for editing the specified order item.
     */
    public function edit($orderId, $itemId)
    {
        $item = OrderItem::findOrFail($itemId);
        $products = Product::all();
        return view('admin.order.items.edit', compact('item', 'products'));
    }

    /**
     * Update the specified order item in storage.
     */
    public function update(Request $request, $orderId, $itemId)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = OrderItem::findOrFail($itemId);
        $item->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('admin.order.items.index', $orderId)->with('message', 'Order item updated.');
    }

    /**
     * Remove the specified order item from storage.
     */
    public function destroy($orderId, $itemId)
    {
        $item = OrderItem::findOrFail($itemId);
        $item->delete();

        return redirect()->route('admin.order.items.index', $orderId)->with('message', 'Order item removed.');
    }
}