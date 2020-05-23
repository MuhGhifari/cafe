<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class KasirController extends Controller
{
    public function index(){
      return view('kasir.index');
    }

    public function addOrder()
  {
    $products = Product::orderBy('created_at', 'DESC')->get();
    return view('kasir.shopcart', compact('products'));
  }

}
