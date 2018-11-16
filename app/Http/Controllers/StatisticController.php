<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\EChart;
use App\Ticket;

class StatisticController extends Controller
{

    protected $ticket;    
    
    public function __construct(Ticket $ticket)
    {        
        $this->ticket = $ticket;
    }    

    public function showIndex()
    {                       
        //Chart Status
        $pendingTicket = $this->ticket->where('status_id', 1)->count();
        $attendingTicket = $this->ticket->where('status_id', 2)->count();
        $finalizedTicket = $this->ticket->where('status_id', 3)->count();
        $canceledTicket = $this->ticket->where('status_id', 4)->count();

        $chartStatus = new EChart;                
        $chartStatus->labels(['Abertos', 'Atendendo', 'Resolvidos', 'Cancelados']);
        $chartStatus->dataset('Tickets', 'pie', [$pendingTicket, $attendingTicket, $finalizedTicket, $canceledTicket])->options([
            'color' => ['#ffb64d', '#4680ff', '#26dad2', '#fc6180']
        ]);
        $chartStatus->minimalist(true);
        
        //Chart Priority
        $normalPriority = $this->ticket->where('priority_id', 1)->count();
        $lowPriority = $this->ticket->where('priority_id', 2)->count();        
        $highPriority = $this->ticket->where('priority_id', 3)->count(); 
        
        $chartPriority = new EChart;         
        $chartPriority->labels(['Baixa', 'Normal', 'Alta']);               
        $chartPriority->dataset('Prioridade', 'pie', [$lowPriority, $normalPriority, $highPriority])->options([
            'color' => ['#4680ff', '#26dad2', '#fc6180']
        ]);
        $chartPriority->minimalist(true);
                
        return view('statistic.index')->with(compact('chartStatus'))->with(compact('chartPriority'));
    }    

}