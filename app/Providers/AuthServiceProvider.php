<?php

namespace App\Providers;

use App\Models\Team;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::before(function ($user, $ability) {
            if ($user->type == 'super-admin') {
                return true;
            }if($user->type == 'user'){
                return false;
            }
        });
        // foreach(config('abilities') as $key=>$value){
        //     $user->hasA
        // }
        
        \Laravel\Sanctum\Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

    }
}
