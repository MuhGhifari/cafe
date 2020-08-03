<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Order;
use App\OrderItem;
use App\Transaction;
use Carbon\Carbon;

class KasirController extends Controller
{
  public function index(){
    $products = Product::orderBy('name', 'ASC')->paginate(8);
    $categories = Category::orderBy('name', 'ASC')->get();
    if (count(auth()->user()->waitingOrder) > 0) {
      $order = auth()->user()->waitingOrder->first();
      $order_id = $order->id;
      $cart = $order->orderItems;
      $cart_total = 0;
      foreach ($cart as $key => $item) {
        $cart_total += $item->product->price * $item->quantity;
      }
      return view('kasir.index', compact('products', 'cart', 'categories', 'order_id', 'cart_total'));
    }else{
      return view('kasir.index', compact('products', 'categories'));
    }
  }

  public function createOrder(Request $request){
    $order = new Order();
    $order->name = $request->name;
    $order->user_id = auth()->user()->id;
    $order->save();
    $output = 
    '<div class="col-lg-12">
        <div class="shoping__checkout" style="background: #f2f2f2; ">
          <h5>Keranjang</h5>
          <ul>
            <li>Total Tagihan<span id="cart-total">'. rupiah(0) .'</span></li>
            <input type="hidden" name="total" id="total" value="{{ $cart_total }}">
            <li>Uang Tunai<span><input type="text" min="0" name="tunai" id="tunai" class="form-control"></span></li>
            <li style="display: none;" id="kembalian-container">Kembalian <span id="kembalian"></span></li>
            <input type="hidden" name="kembalian_value" id="kembalian_value">
          </ul>
          <div class="row">
            <a href="'. route('kasir.delete.order', $order->id) .'" id="remove-order-btn" class="col-md-6 text-center">
              <h5 style="color: white;" class="btn-success m-0 p-3">Cancel Order</h5>
            </a>
            <a href="#" class="col-md-6 text-center" id="bayar">
              <h5 style="color: white;" class="btn-success m-0 p-3">Bayar</h5>
            </a>
            <a href="#" class="col-md-6 text-center" id="kembali" style="display: none;">
              <h5 style="color: white;" class="btn-success m-0 p-3">Kembali</h5>
            </a>
            <a href="#" class="col-md-6 text-center" id="checkout" style="display: none;">
              <h5 style="color: white;" class="btn-success m-0 p-3">Selesai</h5>
            </a>
          </div>
        </div>
      </div>';
    return response()->json(['order_id' => $order->id, 'customer_name' => $request->name, 'output' => $output]);
  }

  public function saveTransaction(Request $request){
    $order = Order::find($request->order_id);
    if ($order->user_id == auth()->user()->id) {
      $type = 'offline';
    }else{
      $type = 'online';
    }
    $transaction = new Transaction();
    $transaction->order_id = $request->order_id;
    $transaction->cashier_id = auth()->user()->id;
    $transaction->change = $request->change;
    $transaction->cash = $request->cash;
    $transaction->total = $request->total;
    $transaction->type = $type;
    $transaction->date = date(now());
    $transaction->save();
    $order->status = 'selesai';
    $order->save();
    $output = 
    '<div class="col-md-12 text-center">
      <h5>Belum ada pesanan</h5>
    </div>';
    return response()->json(['message' => 'Transaksi berhasil!', 'output' => $output]);
  }

  public function deleteOrder($order_id){
    $order = Order::find($order_id);
    $order->delete();
    $output = 
    '<div class="col-md-12 text-center">
      <h5>Belum ada pesanan</h5>
    </div>';
    return response()->json(['output' => $output]);
  }

  public function addItem($product_id, Request $request){
    $order_id = auth()->user()->waitingOrder->first()->id;
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
    $output = "";
    $cart_total = 0;
    foreach ($order->orderItems as $item) {
      $output .= '<tr>'.
      '<td align="left" width="15%">'.
          '<img style="height: 80px; width: 80px;" src="'. asset('img/products/' . $item->product->image) .'">'.
        '</td>'.
        '<td align="center" width="20%">'.
          $item->product->name .
        '</td>'.
        '<td>'.
          rupiah($item->product->price) .
        '</td>'.
        '<td width="14%">'.
          '<input type="hidden" id="order_item_id" name="order_item_id" value="'. $item->id .'">'.
          '<input type="number" class="quantity form-control" id="quantity" name="quantity" value="'. $item->quantity .'" min="1" max="'. $item->product->stock .'" onkeydown="return false">'.
        '</td>'.
        '<td class="item-total">'.
          rupiah($item->product->price * $item->quantity) .
        '</td>'.
        '<td>'.
          '<a href="'. route('kasir.remove.item', $item->product->id ) .'" class="remove-btn">'.
          '<span class="icon_close"></span>'.
          '</a>'.
        '</td>'.
      '</tr>';
      $cart_total += $item->product->price * $item->quantity;
    }
    return response()->json(['output' => $output, 'cart_total' => rupiah($cart_total), 'total' => $cart_total]);
  }

  public function addItemQuantity(Request $request){
    $item = OrderItem::find($request->order_item_id);
    $item->quantity = $request->quantity;
    $item->save();
    $total = $item->product->price * $item->quantity;
    $order = auth()->user()->waitingOrder->first();
    $order_id = $order->id;
    $cart = $order->orderItems;
    $cart_total = 0;
    foreach ($cart as $key => $item) {
      $cart_total += $item->product->price * $item->quantity;
    }
    return response()->json(['product_qty' => $item->quantity, 'total' => $total, 'cart_total' => $cart_total]);
  }

  public function removeItem($product_id){
    $product = OrderItem::where('product_id', $product_id)->first();
    $product->delete();
    $order_id = auth()->user()->waitingOrder->first()->id;
    $order = Order::find($order_id);
    $output = "";
    $cart_total = 0;
    foreach ($order->orderItems as $item) {
      $cart_total += $item->product->price * $item->quantity;
      $output .= '<tr>'.
      '<td align="left" width="15%">'.
          '<img style="height: 80px; width: 80px;" src="'. asset('img/products/' . $item->product->image) .'">'.
        '</td>'.
        '<td align="center" width="20%">'.
          $item->product->name .
        '</td>'.
        '<td>'.
          rupiah($item->product->price) .
        '</td>'.
        '<td width="14%">'.
          '<input type="hidden" id="order_item_id" name="order_item_id" value="'. $item->id .'">'.
          '<input type="number" class="quantity form-control" id="quantity" name="quantity" value="'. $item->quantity .'" min="1" max="'. $item->product->stock .'" onkeydown="return false">'.
        '</td>'.
        '<td class="item-total">'.
          rupiah($item->product->price * $item->quantity) .
        '</td>'.
        '<td>'.
          '<a href="'. route('kasir.remove.item', $item->product->id ) .'" class="remove-btn">'.
          '<span class="icon_close"></span>'.
          '</a>'.
        '</td>'.
      '</tr>';
    }
    return response()->json(['output' => $output, 'cart_total' => rupiah($cart_total), 'total' => $cart_total]);
  }

  public function search(Request $request){
    if ($request->ajax()) {
      $query = $request->get('query');
      $query = str_replace(" ", "%", $query);
      $products = Product::orderBy('name', 'ASC')->where('name', 'LIKE', '%'.$query."%")->paginate(8);
      return view('kasir.product_data', compact('products'))->render();
    }
  }    
}
