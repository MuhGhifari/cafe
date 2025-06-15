<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'product_id');
    }

    public function isFavorited()
    {
        return $this->favorites->where('user_id', auth()->id())->isNotEmpty();
    }

    public function getFavoriteId()
    {
        return Favorite::where('user_id', auth()->id())
                       ->where('product_id', $this->id)
                       ->value('id'); // returns null if not found
    }
}