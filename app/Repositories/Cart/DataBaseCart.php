<?php

namespace App\Repositories\Cart;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class DataBaseCart implements CartRepository
{
    protected $items;
    public function __construct()
    {
        $this->items = collect([]);
    }
    protected $item;
    public function all()
    {
        if(!$this->items->count()){
            return Cart::where('cookie_id', $this->getCookieId())
            ->orWhere('user_id', Auth::id())
            ->get();
        }
        return $this->items;
    }
    public function add($item , $qty = 0)
    {
        $products1 =  $this->cart->all()->load('product:id,slug');
        foreach($products1 as $product){
            $p[] = $product->product->id;
        }
         return $p;
         if($item instanceof $p){
             return redirect()>back();
         }
        $cart= Cart::updateOrCreate([
            'cookie_id' => $this->getCookieId(),
            'product_id' => $item, 
         ] ,[
             'user_id' => Auth::id(),
             'quantity'=> DB::raw('quantity+' . $qty)
         ]
        );
        $row = Product::where('id',$item)->decrement('quantity', $qty); 
        $this->items = collect([]);
        return $cart;
       
    }
    public function clear()
    {
        Cart::all()->where('cookie_id', '=', $this->getCookieId())
            ->orWhere('user_id','=',Auth::id())->delete();
    }
    public function getCookieId()
    {
        $id = Cookie::get('cart_cookie_id');
        if(!$id){
            $id = Str::uuid();
            Cookie::queue('cart_cookie_id' , $id, 30*24*60);
        }
        return $id;
    }
    public function total()
    {
        $items = $this->all();
        return $items->sum(function($item){
             return $item->quantity * $item->product->price;
        });
    }
    public function quantity()
    {
        $items = $this->all();
        return $items->sum('quantity');
    }
} 