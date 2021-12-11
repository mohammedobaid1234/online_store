<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\sendCodeVerificationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class sendCodeVerificationListener
{
   
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
      
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(User $user , $code)
    {
        
        $user->notify(new sendCodeVerificationNotification($code) );
    }
}
    