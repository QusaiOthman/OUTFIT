<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductSize;
use App\Models\WishlistItem;


class Product extends Model
{
    //
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    protected $guarded = [];
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'description',
        'gender',
        'stock',
    ];
}
