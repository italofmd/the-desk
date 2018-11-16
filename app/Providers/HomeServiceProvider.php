<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Ticket;

class HomeServiceProvider extends ServiceProvider
{   

    public function boot()
    {        
        View::composer('layout.index', function ($view) {            
                 
            if(Auth::check()){
                if(Auth::user()->type_id == 1){
                    $ticketPending = Ticket::where('status_id', 1)->count();
                } else {
                    $ticketPending = Ticket::where('status_id', 1)->where('user_id', Auth::user()->id)->count();
                }            
                
                $view->with('ticketPending', $ticketPending);
            }
            
        });
    }
   
    public function register()
    {
        
    }
}
