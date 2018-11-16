<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\User;
use App\Profile;
use App\Ticket;
use Carbon\Carbon;

class HomeController extends Controller
{
   
    protected $ticket;
    protected $user;    
    protected $profile;

    public function __construct(Ticket $ticket, User $user, Profile $profile)
    {        
        $this->ticket = $ticket;
        $this->user = $user;
        $this->profile = $profile;
    }

    public function index()
    {
        $firstToday = Carbon::parse(Carbon::today())->format('Y-m-d 00:00:00');
        $lastToday = Carbon::parse(Carbon::today())->format('Y-m-d 23:59:59');

        $date = new Carbon('first day of now');
        $firstDay = Carbon::parse($date)->format('Y-m-d 00:00:00');
        $lastDay = Carbon::parse(Carbon::today())->format('Y-m-d 23:59:59'); 

        if(Auth::user()->type_id == 1){
            $ticketToday = DB::table('ticket')
                            ->whereBetween('created_at', [$firstToday, $lastToday])
                            ->count();
                        
            $ticketMonth = DB::table('ticket')
                            ->whereBetween('created_at', [$firstDay, $lastDay])
                            ->count();
            
            $ticketResolved = $this->ticket->all()->where('status_id', 3)->count();
            $ticketTotal = $this->ticket->all()->count();

            $ticket = $this->ticket->all()->where('status_id', '<=', 2);
        } else {
            $ticketToday = DB::table('ticket')
                            ->whereBetween('created_at', [$firstToday, $lastToday])
                            ->where('user_id', Auth::user()->id)
                            ->count();
                           
            $ticketMonth = DB::table('ticket')
                            ->whereBetween('created_at', [$firstDay, $lastDay])
                            ->where('user_id', Auth::user()->id)
                            ->count();

            $ticketResolved = $this->ticket->all()->where('status_id', 3)->where('user_id', Auth::user()->id)->count();
            $ticketTotal = $this->ticket->all()->where('user_id', Auth::user()->id)->count();

            $ticket = $this->ticket->all()->where('status_id', '<=', 2)->where('user_id', Auth::user()->id);            
        }
            
        return view('dashboard.index')->with(compact('ticket'))->with(compact('ticketResolved'))->with(compact('ticketTotal'))->with(compact('ticketMonth'))->with(compact('ticketToday'));
    }

    public function showNotification()
    {
        return view('dashboard.notification');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function saveRegister(RegisterRequest $request)
    {
        $dataUser = [
            'name' => upperStart($request->name),
            'email' => lowerAll($request->email),
            'password' => Hash::make($request->password),
            'type_id' => 2
        ];
        
        $user = $this->user->create($dataUser);
        
        $data['user_id'] = $user->id;
        $profile = $this->profile->create($data);
             
        $notification = array(
            'message' => 'Usuário cadastrado com sucesso',
            'alert-type' => 'success'              
        );            
        
        return redirect()->route('login')->with($notification);
    }

}
