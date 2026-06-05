<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function getImageUrlAttribute()
    {
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }
}
