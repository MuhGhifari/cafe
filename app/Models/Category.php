<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    protected $guarded = ['id'];

    /**
     * Get all products that belong to this category.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}