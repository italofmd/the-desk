<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Message;
use Carbon\Carbon;

class MessageServiceProvider extends ServiceProvider
{
   
    public function boot()
    {
        View::composer('*', function ($view) {                        
            if(Auth::check()){

                Carbon::setLocale('pt-BR');

                if(Auth::user()->type_id == 1){
                    $message = Message::all()->where('user_id', '!=', Auth::user()->id)->where('read', false)->sortByDesc('id');
                } else {
                    $message = Message::whereHas('getTicket', function ($query) {
                        $query->where('user_id', Auth::user()->id);
                    })
                    ->where('user_id', '!=', Auth::user()->id)->where('read', false)->orderBy('id', 'desc')->get();
                }                
                
                if($message->isNotEmpty() == true){
                    foreach($message as $key => $m){
                    
                        $date = Carbon::parse($m->created_at);
    
                        $messages[$key] = [
                            'id' => $m->getTicket->id,
                            'user' => $m->getUser->name,
                            'message' => $m->message,
                            'date' => $date->diffForHumans(),
                            'color' => $m->getColor($key),
                            'image' => $m->getUser->getProfile->file
                        ];
                    }
                } else {
                    $messages = null;
                }
                
                $view->with('messages', $messages);
            }            
        });
    }

    public function register()
    {
        
    }
}
