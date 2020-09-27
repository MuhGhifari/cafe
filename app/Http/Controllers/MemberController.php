<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Product;
use App\Category;
use App\Order;
use App\OrderItem;
use App\Transaction;
use App\Favorite;
use Carbon\Carbon;

class MemberController extends Controller
{
 	public function index(){
    return view('member.index');
  }

  public function test(){
  	dd('OFINV'.str_pad(1, 6, "0", STR_PAD_LEFT));
  }

  public function showCart(){
  	$user = auth()->user();
  	if (count($user->waitingOrder) > 0) {
  		$order = $user->waitingOrder->first();
  		$order_id = $order->id;
  		$cart = $order->orderItems;
  		$cart_total = 0;
  		foreach ($cart as $key => $item) {
  			$cart_total += $item->product->price * $item->quantity;
  		}
  		return view('member.shopcart', compact('cart', 'order' ,'order_id', 'cart_total'));
  	}
  	else{
  		$cart_total = 0;
  		return view('member.shopcart', compact('cart_total'));
  	}
  }

  public function addItem(Request $request){
  	$request->validate([
  	    'product_id' => 'numeric|required',
  	    'order_id' => 'numeric|nullable',
  	]);

  	$user = auth()->user();
  	if ($request->order_id == null) {
  		$order = new Order();
  		$order->name = $user->name;
  		$order->user_id = $user->id;
  		$order->save();
  		$order_id = $order->id;
  	}
  	else{
  		$order_id = $request->order_id;
  	}
  	$product_id = $request->product_id;
  	$order = Order::find($order_id);
  	$bingo = false; 
    foreach ($order->orderItems as $key => $order_item) { 
      if ($product_id == $order_item->product_id) {
        $order_item->quantity = $order_item->quantity + 1;
        $order_item->save();
        $bingo = true;
        break;
      }
    }
    if ($bingo == false) {
      $new_item = new OrderItem();
      $new_item->order_id = $order_id;
      $new_item->product_id = $product_id;
      $new_item->save();
      $order->refresh();
    }
    $user->refresh();
  	if ($request->ajax()) {
  		return response()->json(['success' => 'Produk berhasil ditambahkan ke keranjang!', 'item_qty' => count($user->waitingOrder->first()->orderItems), 'order_id' => $order_id]);
  	}
  	else{
  		return redirect()->route('member.shopcart');
  	}
  }

  public function addItemQuantity(Request $request){
  	$item = OrderItem::find($request->order_item_id);
    $item->quantity = $request->quantity;
    $item->save();
    $item_total = rupiah($item->product->price * $item->quantity);
    $order = auth()->user()->waitingOrder->first();
    $order_id = $order->id;
    $cart = $order->orderItems;
    $cart_total = 0;	
    return response()->json(['product_qty' => $item->quantity, 'item_total' => $item_total, 'cart_total' => rupiah($cart_total)]);
  }

  public function removeItem($order_item_id){
  	$order_item = OrderItem::find($order_item_id);
  	$order = $order_item->order;
    $order_item->delete();
    $empty = false;
    if (count($order->orderItems) < 1) {
    	$order->delete();
    	$empty = true;
    }
    return response()->json(['success' => 'Produk berhasil di hapus dari keranjang', 'kosong' => $empty]);
  }

  public function showFavorites(){
  	$faves = Favorite::where('user_id', auth()->user()->id)->paginate(8);
  	return view('member.favorites', compact('faves'));
  }

 	public function showInvoice($invoice){
 		$order = Order::where('invoice', $invoice)->first();
 		$total = 0;
 		foreach ($order->orderItems as $key => $item) {
 			$total += $item->quantity * $item->product->price;
 		}
 		return view('member.invoice', compact('order', 'total'));
 	}

 	public function showInvoiceList(){
 		$orders = auth()->user()->InvoiceList;
    foreach ($orders as $key => $order) {
      $total = 0;
      foreach ($order->orderItems as $key => $item) {
        $total += $item->quantity * $item->product->price;
      }
      $order->total = $total;
    }
 		return view('member.invoice_list', compact('orders'));
 	}

  public function cancelOrder($order_id){
    $order = Order::find($order_id);
    $order->delete();
    return redirect()->route('member.show.orders');
  }

  public function showTransaction($order_id){
    $transaction = Transaction::where('order_id', $order_id)->first();
    $transaction->kasir = $transaction->cashier->name;
    $transaction->invoice = $transaction->order->invoice;
    $transaction->pemesan = $transaction->order->name;
    $transaction->tanggal = Carbon::parse($transaction->created_at)->format('d-m-yy h:i:s');
    return response()->json($transaction);
  }

  public function saveFavorite($product_id){
  	$faves = auth()->user()->favorites;
  	$bingo = false;
  	foreach ($faves as $key => $fave) {
  		if ($fave->product_id == $product_id) {
  			$bingo = true;
  		}
  	}
  	if ($bingo == false) {
  		$new = new Favorite();
  		$new->user_id = auth()->user()->id;
  		$new->product_id = $product_id;
  		$new->save();
  	}
  	return response()->json(['fave_id' => $new->id]);
  	// return view('member.favorites', compact('faves'));
  }

  public function removeFavorite(Request $request, $id){
  	$fave = Favorite::find($id);
  	$fave->delete();
  	if ($request->ajax()) {
	  	return response()->json();
  	}
  	else{
  		return redirect()->route('member.show.favorites');
  	}
  }

  public function generateInvoice(Request $request){
  	$request->validate([
  		'order_id' => 'required|numeric'
  	]);
  	$invoice = 'OLINV'. str_pad($request->order_id, 6, "0", STR_PAD_LEFT);
  	$order = Order::find($request->order_id);
  	$order->invoice = $invoice;
  	$order->status = 'diproses';
  	$order->save();
  	return redirect()->route('member.invoice', $order->invoice);
  }
}
