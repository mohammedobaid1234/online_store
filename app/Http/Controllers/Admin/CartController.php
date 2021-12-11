<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{   
    protected $cart =[] ;
    /**
     * @var App\Repositories\Cart\CartRepository
     */
    public function __construct(CartRepository $cart){
        $this->cart = $cart;
    }
     
    public function index()
    {
         $cart = $this->cart->all();
        //  return $cart;
        //  return $cart[0]->products;
        //  return $cart[0]->products;
        return view('fronts/cart', [
            'cart' => $this->cart->all(),
            'total' =>$this->cart->total()
    ]);
    }
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'product_id' => ['required' , 'exists:products,id'],
            function($att,$value, $fail){
                $id = request('product_id');
                $product = Product::find($id);
                if($value > $product->quantity){
                    $fail(__('Quantity grater than in Stack'));
                }
            } 
        ]);
        $this->cart->add($request->post('product_id'),$request->post('quantity', 1));
        // dd($cart);
        $cart = $this->cart->all();
         if($request->expectsJson()){
              return [
                 'cart' =>  $cart ,
                'count' => $this->cart->quantity()];
         }
        // return $r;
        return $cart;
        return redirect()->back();

    }
    public function increaseQuantity($id)
    {
        $cart = Cart::where('id', $id)->first(); 
        $cart_quantity = $cart->quantity += 1;
        $cart->update([
            'quantity' => $cart_quantity
        ]);
        return redirect()->back();
    }
    public function decreaseQuantity($id)
    {
        $cart = Cart::where('id', $id)->first(); 
        $cart_quantity = $cart->quantity += 1;
        $cart->update([
            'quantity' => $cart_quantity
        ]);
        return redirect()->back();
    }
    public function deleteItem($id)
    {
        $cart = Cart::where('id', $id)->first(); 
        $cart->delete();
        return redirect()->back();
    }
}
