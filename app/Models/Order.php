<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Events\ForNewOrdersEvent;

class Order extends Model
{
    use HasFactory,Notifiable;
    
    protected $table="orders";

    protected $fillable = [
        'category', 'quantity', 'amount',
    ];
    protected $dispatchesEvents = [
     
        "created" => ForNewOrdersEvent::class,
        
    ]; 
}
