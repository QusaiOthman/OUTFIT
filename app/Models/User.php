<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Cart;
use App\Models\WishlistItem;
use App\Notifications\VerifyEmailNotification;
use App\Notifications\ResetPasswordNotification;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{

    use HasApiTokens;
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'admin_notes',
        'image',
        'is_suspended',
        'is_admin',
        'email_verified_at',
        'customer_level',
        'customer_level_override',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'customer_level_override' => 'string',
        ];
    }
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }

    // Notifications
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    // Accessors
    public function getCustomerLevelAttribute()
    {
        if ($this->customer_level_override) {
            return $this->customer_level_override;
        }

        $settings = \App\Models\Setting::getSettings();

        $totalSpent = $this->orders->sum('total');

        if ($totalSpent >= $settings->elite_customer_minimum) {
            return 'Elite';
        }

        if ($totalSpent >= $settings->vip_customer_minimum) {
            return 'VIP';
        }

        if ($totalSpent >= $settings->premium_customer_minimum) {
            return 'Premium';
        }

        return 'Standard';
    }
    public function getImageUrlAttribute()
    {
        return $this->image
            ? (str_starts_with($this->image, 'http')
                ? $this->image
                : asset('storage/' . $this->image))
            : null;
    }
}
