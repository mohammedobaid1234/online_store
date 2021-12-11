<?php

namespace App\Models;

use App\Observers\OrderObserve;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'user_id',
        'sipping',
        'discount',
        'tax',
        'total',
       'status',
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_city',
        'billing_country',
       'payment_status',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_city',
        'shipping_country',   
        'notes' 
    ];
    protected static function booted()
    {
        static::observe(OrderObserve::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class); 
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
        ->using(OrderItem::class)
        ->as('items')
        ->withPivot(['quantity','price']);
    }

}
