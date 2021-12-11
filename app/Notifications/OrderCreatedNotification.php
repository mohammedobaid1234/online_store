<?php

namespace App\Notifications;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\NexmoMessage;
class OrderCreatedNotification extends Notification
{
    use Queueable;
    /**
     * @var \App\Models\Order
     */
    protected $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */

        public function __construct(Order $order)
        {
           return $this->order = $order;
        }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail' , 'database'  ,'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {  
        return (new MailMessage)
                    ->from('billing@info.com', 'GSG Billing')
                    ->subject(__('New Order # :number', ['number' => $this->order->number]))
                    ->greeting(__('Hi :name', ['name' => $this->order->billing_name]))
                    ->line(__('This is For New Order #:number', ['number' => $this->order->number]))
                    ->action(__('View Order'), url('/'))
                    ->line(__('Thank you for using our application!'));
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->order->id,
            'title' => __('New Order # :number', ['number' => $this->order->number]),
            'body' => (__('This is For New Order #:number', ['number' => $this->order->number])),
            'url' => '',
            'icon' => '',
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => __('New Order # :number', ['number' => $this->order->number]),
            'body' => (__('This is For New Order #:number', ['number' => $this->order->number])),
            'url' => '',
            'icon' => '',
            'created_at' => Carbon::now()->diffForHumans(),
        ]);
    }
    public function toNexmo($notifiable)
    {
        $message = new NexmoMessage();
        $message->content(__('New Order #:number', ['number' => $this->order->number]));
        return $message;
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
