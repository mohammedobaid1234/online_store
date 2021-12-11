<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ChatUsers extends Component
{
    public $users;
    public $messages;
    public $unread;
    // public $messages= $this->user->messages()->where('seen', 0)->get();
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->users = User::where('id', '<>', Auth::id())->limit(5)->get();
        $user = Auth::user();
        $this->users = $user->load('messages');
        $this->messages = $this->users->messages()->where('seen', 0)->get();  
        $this->unread = $this->messages->count(); 
    }
    
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.chat-users');
    }
}
