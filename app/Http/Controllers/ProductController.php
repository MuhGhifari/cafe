<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'required|image|mimes:png,jpeg,jpg|dimensions:ratio=1/1',
            'price' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $product = new Product();
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->varian = $request->varian;
            $product->price = $request->price;
            $product->save(); // Save first to get the ID

            $filename = $product->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/products'), $filename);

            $product->image = $filename;
            $product->save();
        }

        return redirect()->route('admin.product')->with('message', 'Success Create Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'image' => 'nullable|image|mimes:png,jpeg,jpg|dimensions:ratio=1/1',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $imagePath = public_path('img/products/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $file = $request->file('image');
            $filename = $product->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/products'), $filename);
            $product->image = $filename;
        }

        $product->save();

        return redirect()->route('admin.product')->with('message', 'Success Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $imagePath = public_path('img/products/' . $product->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $product->delete();

        return redirect()->route('admin.product')->with('message', 'Product deleted successfully.');
    }
}