<?php 

namespace App\Repositories\Cart;

interface CartRepository
{
    public function all();
    public function add($item, $qty = 0);
    public function clear();
}