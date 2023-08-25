<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

use App\Events\ForNewOrdersEvent;


class OrderController extends Controller
{
    public function create(Request $request){
        // dd($request->all());
        
        $order=Order::create([
            'category'=>$request->category,
            'quantity'=>$request->quantity,
            'amount'=>$request->amount
        ]);
        // dd($order);
        if ($order) {
            // Event::dispatch(new ForNewOrdersEvent($order));
            // event(new ForNewOrdersEvent($order));
            return "Order Created";
        }
    }
}
