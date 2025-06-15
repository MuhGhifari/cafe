<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Add product to user's favorites.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();

        // Check if already favorited
        $exists = Favorite::where('user_id', $user->id)
                          ->where('product_id', $request->product_id)
                          ->exists();

        if (!$exists) {
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
            ]);
        }

        return back()->with('message', 'Product favorited successfully.');
    }

    /**
     * Remove a favorite.
     */
    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);

        // Optional: Ensure user can only delete their own favorites
        if ($favorite->user_id !== Auth::id()) {
            abort(403);
        }

        $favorite->delete();

        return back()->with('message', 'Favorite removed.');
    }

    /**
     * List all favorites of the logged-in user.
     */
    public function index()
    {
        $favorites = Favorite::with('product')
                             ->where('user_id', Auth::id())
                             ->get();

        return view('user.favorites.index', compact('favorites'));
    }
}