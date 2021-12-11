<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use Symfony\Component\Intl\Countries;
use App\Models\Order;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class CheckoutController extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart)
    {
      $this->cart = $cart;  
    }

    public function create()
    {   
        
        return view('fronts.check-out',[
            'cart' => $this->cart,
            'user'=> Auth::user(),
            'counties' => Countries::getNames()
        ]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'user_id' => Auth::id(),
            'total' => $this->cart->total(),
        ]);
        $request->validate([
            'billing_name' => ['required','string'],
            'billing_phone' => ['required'],
            'billing_email' => ['required'],
            'billing_city' => ['required'],
            'billing_country' => ['required'],
        ]);
        
        DB::beginTransaction();
        try{
            
            $order = Order::create($request->all());
            $items = [];
            foreach($this->cart->all() as $item){
                $items[] = [
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ];
                
                
            }
            DB::table('order_items')->insert($items);
            DB::commit();
            //return route('orders');
            event(new OrderCreated($order));
            // return $order;
            return redirect()->route('home.index');
            // return $order;
            // dd($request);

           }catch(Throwable $e){
               DB::rollBack();
               throw $e;
           }


     
    }
}
