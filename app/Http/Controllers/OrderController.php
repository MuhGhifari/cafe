<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $users = User::all(); // Assuming the order is tied to a user
        return view('admin.order.create', compact('users'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'user_id'   => 'required|exists:users,id',
            'invoice'   => 'nullable|string|unique:orders,invoice',
            'status'    => 'required|in:selesai,menunggu,diproses',
        ]);

        Order::create($request->only('name', 'user_id', 'invoice', 'status'));

        return redirect()->route('admin.order.index')->with('message', 'Order created successfully.');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $users = User::all();
        return view('admin.order.edit', compact('order', 'users'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'user_id' => 'required|exists:users,id',
            'status'  => 'required|in:selesai,menunggu,diproses',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->only('name', 'user_id', 'status'));

        return redirect()->route('admin.order.index')->with('message', 'Order updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.order.index')->with('message', 'Order deleted successfully.');
    }
}