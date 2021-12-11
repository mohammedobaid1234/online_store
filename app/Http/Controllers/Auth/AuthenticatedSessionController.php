<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuthenticatedSessionController extends Controller
{

    protected $guard = 'web';
    public function __construct(Request $request)
    {
        if($request->is('admin/*')){
            $this->guard = 'admins';
        }if($request->is('merchant/*')){
            $this->guard = 'merchants';           
        }
    }
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if($this->guard == 'web'){
            $route = 'login';
        }elseif($this->guard == 'admins'){
            $route = 'admins.login';

        }else{
            $route = 'merchants.login';
        }
        return view('auth.login', [
            'guard' => $this->guard,
            'route' => $route,
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->guard = $this->guard;
        // dd($this->guard);
        $request->authenticate();

        $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        
        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard($this->guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
