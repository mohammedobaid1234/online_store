<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $cart;
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    //
    public function index()
    {
        
        
        $products =  Product::latest()->limit(10)->get();
        // return $products;
        return view('fronts.home' , [
            'products' => $products
        
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        // dd($product);
        return view('fronts.product-details', ['product' => $product]);
    }
}
