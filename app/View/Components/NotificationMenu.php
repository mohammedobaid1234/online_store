<?php

namespace App\View\Components;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationMenu extends Component
{
    public $notification;
    public $unread;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Notification $notification)
    {
        $user = Auth::user();
        $this->notification = $user->notifications->take(5);
        $this->unread = $user->unreadNotifications->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {   
        // dd($this->notification);
        return view('components.notification-menu');
    }
}
