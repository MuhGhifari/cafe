<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions.
     */
    public function index()
    {
        $transactions = Transaction::with('order', 'cashier')->latest()->get();
        return view('admin.transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        $orders = Order::where('status', 'selesai')->get();
        $cashiers = User::where('role', 'kasir')->get();

        return view('admin.transaction.create', compact('orders', 'cashiers'));
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'cashier_id' => 'required|exists:users,id',
            'type' => 'required|in:offline,online',
            'total' => 'required|integer',
            'cash' => 'required|integer|min:0',
        ]);

        $change = $request->cash - $request->total;

        Transaction::create([
            'order_id' => $request->order_id,
            'cashier_id' => $request->cashier_id,
            'type' => $request->type,
            'total' => $request->total,
            'cash' => $request->cash,
            'change' => $change,
        ]);

        return redirect()->route('admin.transaction')->with('message', 'Transaction recorded successfully.');
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaction)
    {
        return view('admin.transaction.show', compact('transaction'));
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.transaction')->with('message', 'Transaction deleted.');
    }
}