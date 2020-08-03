<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Order;
use App\OrderItems;
use App\Transaction;
use App\Favorite;
use Carbon\Carbon;

class MemberController extends Controller
{
 	public function index(){
    return view('member.index');
  }

  public function test(){
  	$products = Product::all();
  	foreach ($products as $key => $product) {
  		if ($product->favorited() == true) {
  			removeFavorite($product->id);
  			var_dump('product id : '. $product->id . ', nama : '.  $product->name  .', bingo : true'. ', faveID : ' . $product->getFaveId(). '<br>');
  		}else{
  			var_dump('product id : '. $product->id . ', nama : '.  $product->name  .', bingo : false'.'<br>');
  		}
  	}
  	die();
  }

  public function showCart(){
  	$user = auth()->user();
  	if (count($user->waitingOrder) > 0) {
  		$order = $user->waitingOrder->first();
  		$cart = $order->orderItems;
  		$cart_total = 0;
  		foreach ($cart as $key => $item) {
  			$cart_total += $item->product->price * $item->quantity;
  		}
  		return view('member.shopcart', compact('cart', 'order', 'cart_total'));
  	}
  	else{
  		return view('member.shopcart');
  	}
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

  public function removeFavorite($id){
  	$fave = Favorite::find($id);
  	$fave->delete();
  	return response()->json();
  }

  public function showFavorite(){
  	$user = auth()->user();
  	$fav_products = $user->favorites;
  	return view('member.favorites', compact('fav_products'));
  }
}
