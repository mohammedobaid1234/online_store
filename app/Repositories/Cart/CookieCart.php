<?php

namespace App\Repositories\Cart;

use Illuminate\Support\Facades\Cookie;


class CookieCart implements CartRepository
{
    protected $name = 'cart';
    public function all()
    {
     $items= Cookie::get($this->name);
        if($items){
            return unserialize($items);
        }
        return [];
    }
    public function add($item , $qty = 1)
    {
        $items = $this->all();
        $items [] = $item;
        Cookie::queue($this->name, serialize($items) , 30*24*60);
    }
    public function clear()
    {
        Cookie::queue($this->name, '' , -60);

    }
} 