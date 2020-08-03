<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Favorite;

class Product extends Model
{
  protected $guarded = ['id'];

  public function favorites(){
    return $this->hasMany('App\Favorite', 'product_id');
  }

  public function favorited(){
    $bingo = false;
    foreach ($this->favorites as $key => $favorite) {
      if ($favorite->user_id == auth()->user()->id) {
        $bingo = true;
      }
    }
    return $bingo;
  }

  public function getFaveId(){
    $fave = Favorite::where('user_id', auth()->user()->id)->where('product_id', $this->id)->first();
    return $fave->id;
  }
}
