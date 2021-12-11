<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use App\Rules\Filter;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    protected $invalid_word;
    public function boot()
    {
        //rather than register namespace of controller => you register the name of controller 
        Relation::morphMap([
            'product' => Product::class,
            'user' => User::class
        ]);
        // filter validation (custom validation)
        Validator::extend('Filter' , function ($attribute, $value, $param) {   
            foreach($param  as  $word){
                
                if(stripos($value, $word) !== false){
                    $this->invalid_word = $word;
                   return false;
                }
            }
            return true;
        }, 'Sorry, Can\'t use this word ');
        // pagination page by bootstrap
        Paginator::useBootstrap();
        }
}
