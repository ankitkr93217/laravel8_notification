<?php

namespace App\Listeners;

use App\Events\ForNewOrdersEvent;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
// use App\Models\Order;
 
class NewOrdersListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
      
     

    /**
     * Handle the event.
     *
     * @param  \App\Events\ForNewUsersEvent  $event
     * @return void
     */
    public function handle(ForNewOrdersEvent $event)
    {
        // dd($event->order);
        // $admins = User::whereHas('role', function ($query) {
        //     $query->where('role',1);
        // })->get();
        $admins = User::where('role',1)->get();
        // dd($admins);
        // $admins->notify(new NewOrderNotification($event->order));
        Notification::send($admins,new NewOrderNotification($event->order));
    }
}
