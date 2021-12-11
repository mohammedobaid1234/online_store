<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Cart extends Model
{
    use HasFactory;
    protected $with = [
        'product'
    ];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
    ];
    protected static function booted()
    {
        static::creating(function(Cart $cart){
            $cart->id = Str::uuid();
        });
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
