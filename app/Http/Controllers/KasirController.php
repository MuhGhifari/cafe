<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class KasirController extends Controller
{
    public function index(){
      $products = Product::orderBy('name', 'DESC')->paginate(9);
      $categories = Category::orderBy('name', 'DESC')->get();
      return view('kasir.index', compact('products', 'categories'));
    }

    public function addOrder()
  {
    $products = Product::orderBy('created_at', 'DESC')->get();
    return view('kasir.shopcart', compact('products'));
  }

}
