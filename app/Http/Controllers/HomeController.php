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


    public function product(){

        $products = Product::all();
        return view('admin.product.product', compact('products'));
    }

    public function created(){
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.product.createproduct', compact('categories'));
    }

    public function stored(Request $request ){
        
        // Validate
        $this->validate($request,[
                'name' => 'required|string|max:100',
                'image' => 'required|image|mimes:png,jpeg,jpg|dimensions:ratio=1/1', // validasi gambar harus seperti disamping
                'price' => 'required|integer'

        ]);
        //  dd($request);

        //  jika file nya ada
        if($request->hasfile('image')){

            $file = $request->file('image'); // Simpan sementara file dalam file

            

            $product = new Product();
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->varian = $request->varian;
            $product->price = $request->price;
            
            $filename = $product->id . '.' . $file->getClientOriginalExtension(); // 
            $file->move(public_path('img/products'), $filename);

            $product->image = $filename;
            $product->save();

        }
        
        return redirect()->route('admin.product')->with('message','Success Create Data');
    }

    public function edited($id){
        $products = Product::where('id','=',$id)->first();
        return view('admin.product.product',compact('products'));
    }

    public function update(Request $reques, $id){
        $product = Product::find($id);

        $product = [
            'name' => $request->name,
            'image' => $request->name,
            'price' => $request->price
        ];
        $product->name = $request->name;
        $product->image = $request->image;
        $product->price = $request->price;
        
        $product->save();
        return redirect()->route('admin.product.product')->with('message','Success Updated');
    }

    public function cetak_pdf()
    {
        set_time_limit(0);
        $products = Product::all();
        $pdf = \PDF::loadview('admin.laporan_pdf',['products'=>$products]);
        return $pdf->stream();
    }

    public function destroyed($id){
        DB::table('products')->where('id','=',$id)->delete();
        return redirect()->route('admin.product')->with('message','Success Deleted');
    }

}
