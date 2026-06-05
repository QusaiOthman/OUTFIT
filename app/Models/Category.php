<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    protected $guarded = [];
    protected $fillable = [
        'name',
        'image',
    ];
    public function getImageUrlAttribute()
    {
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }
}
