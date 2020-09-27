<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use DB;
use File;
use PDF;
use Storage;

class HomeController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at', 'DESC')->paginate(9);
        $categories = Category::all();
        return view('home', compact('products', 'categories'));
    }

    public function auth()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.index');
        }
        elseif (auth()->user()->role == 'kasir') {
            return redirect()->route('kasir.index');
        }
        else{
            return view('home', compact('products'));
        }
    }

    public function showCategory($id, $slug){
        $products = Product::where('category_id', $id)->paginate(9);
        $categories = Category::all();
        return view('home', compact('products', 'categories'));
    }


    

}
