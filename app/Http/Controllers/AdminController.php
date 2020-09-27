<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use DB;
use PDF;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
      return view('admin.index');
    }
     public function user()
    {
        $users = User::all();
        return view('admin.user',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return redirect()->route('admin.user')->with('message', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('id','=',$id)->first();
        return view('admin.edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $Users = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ];
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        $user->save();
        return redirect()->route('admin.user')->with('message','Berhasil Di Update');
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

    public function updated(Request $reques, $id){
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id','=',$id)->delete();
        return redirect()->route('admin.user')->with('message','Berhasil Terhapus');

    }

}
