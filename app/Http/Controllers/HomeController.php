<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\ForNewUsersEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {

             // $notifications = auth()->user()->unreadNotifications;
                $user = User::where('id','=',Auth::user()->id)->where('role',1);
        
                // foreach ($user->notifications as $notification) {
                //     echo $notification->data;
                // }
                // $notifications=DB::table('notifications')->where('notifiable_id',Auth::user()->id);
                // print_r($notifications);exit;
                // $notifications=$user->notifications;
                $notifications = auth()->user()->unreadNotifications;
                //   echo"<pre>";print_r($notifications[0]->data);echo"</pre>";exit;
                // dd($notifications);
            return view('home',compact('notifications'));
             
        } catch (\Exception $th) {
            echo $th->getMessage();
        }
       
    }

    public function markNotification(Request $request){
        // return $request->id;
        $status = auth()->user()->unreadNotifications
            ->when($request->id, function ($query) use ($request) {
                return $query->where('id', $request->id);
            })->markAsRead();
            return true;
        // return response()->noContent();
    }
}
