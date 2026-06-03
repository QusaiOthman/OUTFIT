<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public static function getSettings()
    {
        return self::firstOrCreate([]);
    }
    
    protected $fillable = [

        'shipping_price',

        'free_shipping_minimum',

        'premium_customer_minimum',

        'vip_customer_minimum',

        'elite_customer_minimum'

    ];
}
