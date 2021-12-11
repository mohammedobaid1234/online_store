<?php

namespace App\Providers;

use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CookieCart;
use App\Repositories\Cart\DataBaseCart;
use App\Repositories\Cart\SessionCart;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CartRepository::class, function(){
            if(config('cart.driver') == 'cookie'){
                return new CookieCart();
            }elseif(config('cart.driver') == 'session'){
                return new SessionCart();
            }else{
                return new DataBaseCart();
            }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
