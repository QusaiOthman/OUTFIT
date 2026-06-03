<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Order Statuses
    |--------------------------------------------------------------------------
    */

    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    /*
    |--------------------------------------------------------------------------
    | Completed / Revenue Statuses
    |--------------------------------------------------------------------------
    */

    public static function revenueStatuses()
    {
        return [
            self::STATUS_PAID,
            self::STATUS_SHIPPED,
            self::STATUS_DELIVERED,
        ];
    }

    
    public static function statuses()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_PAID,
            self::STATUS_SHIPPED,
            self::STATUS_DELIVERED,
            self::STATUS_CANCELLED,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // we may delete this method later, but for now it is useful to have a direct relationship to items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Fillable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'user_id',
        'name',
        'total',
        'status',
        'shipping',
        'subtotal',
    ];
}
