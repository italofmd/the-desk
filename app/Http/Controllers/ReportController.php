<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReportPeriodRequest;
use Illuminate\Support\Facades\App;
use App\Ticket;
use App\TicketCategory;
use App\Status;
use Carbon\Carbon;

class ReportController extends Controller
{

    protected $ticket;
    protected $category;
    protected $status;
    protected $pdf;

    public function __construct(Ticket $ticket, TicketCategory $category, Status $status)
    {        
        $this->ticket = $ticket;
        $this->category = $category;
        $this->status = $status;
        $this->pdf = App::make('dompdf.wrapper');
    }

    public function showIndex()
    {
        if(Auth::user()->type_id == 1){
            $totalTicket = $this->ticket->count();
            $pendingTicket = $this->ticket->where('status_id', 1)->count();
            $attendingTicket = $this->ticket->where('status_id', 2)->count();
            $finalizedTicket = $this->ticket->where('status_id', 3)->count();
            $canceledTicket = $this->ticket->where('status_id', 4)->count();
    
            $normalPriority = $this->ticket->where('priority_id', 1)->count();
            $lowPriority = $this->ticket->where('priority_id', 2)->count();
            $highPriority = $this->ticket->where('priority_id', 3)->count();

            $category = DB::table('ticket_category')
                        ->select(DB::raw('count(*) as amount, name'))
                        ->join('ticket', 'ticket.category_id', 'ticket_category.id')
                        ->groupBy('ticket_category.name')->get();                            

            $uncategory = $this->ticket->where('category_id', null)->count();
            $untype = $this->ticket->where('equipment_id', null)->count();
    
            $typeEquipment = DB::table('type_equipment')
                            ->select(DB::raw('count(*) as amount, type_equipment.name'))
                            ->join('equipment', 'equipment.type_id', 'type_equipment.id')
                            ->join('ticket', 'ticket.equipment_id', 'equipment.id')
                            ->groupBy('type_equipment.name')->get();
    
            return view('report.index')->with(compact('totalTicket'))->with(compact('pendingTicket'))->with(compact('attendingTicket'))->with(compact('finalizedTicket'))->with(compact('canceledTicket'))->with(compact('normalPriority'))->with(compact('lowPriority'))->with(compact('highPriority'))->with(compact('category'))->with(compact('typeEquipment'))->with(compact('uncategory'))->with(compact('untype'));
        } else {
            abort(401);
        }
    }

    public function showPrint()
    {
        if(Auth::user()->type_id == 1){
            $totalTicket = $this->ticket->count();
            $pendingTicket = $this->ticket->where('status_id', 1)->count();
            $attendingTicket = $this->ticket->where('status_id', 2)->count();
            $finalizedTicket = $this->ticket->where('status_id', 3)->count();
            $canceledTicket = $this->ticket->where('status_id', 4)->count();
    
            $normalPriority = $this->ticket->where('priority_id', 1)->count();
            $lowPriority = $this->ticket->where('priority_id', 2)->count();
            $highPriority = $this->ticket->where('priority_id', 3)->count();

            $category = DB::table('ticket_category')
                        ->select(DB::raw('count(*) as amount, name'))
                        ->join('ticket', 'ticket.category_id', 'ticket_category.id')
                        ->groupBy('ticket_category.name')->get();                            

            $uncategory = $this->ticket->where('category_id', null)->count();
            $untype = $this->ticket->where('equipment_id', null)->count();
    
            $typeEquipment = DB::table('type_equipment')
                            ->select(DB::raw('count(*) as amount, type_equipment.name'))
                            ->join('equipment', 'equipment.type_id', 'type_equipment.id')
                            ->join('ticket', 'ticket.equipment_id', 'equipment.id')
                            ->groupBy('type_equipment.name')->get();                       
    
            return view('report.print')->with(compact('totalTicket'))->with(compact('pendingTicket'))->with(compact('attendingTicket'))->with(compact('finalizedTicket'))->with(compact('canceledTicket'))->with(compact('normalPriority'))->with(compact('lowPriority'))->with(compact('highPriority'))->with(compact('category'))->with(compact('typeEquipment'))->with(compact('uncategory'))->with(compact('untype'));
        } else {
            abort(401);
        }        
    }

    public function showPeriod()
    {
        if(Auth::user()->type_id == 1){
            $status = $this->status->all();
            return view('report.search')->with(compact('status'));
        } else {
            abort(401);
        }
    }

    public function savePeriod(ReportPeriodRequest $request)
    {        
        if(Auth::user()->type_id == 1){
            $start = Carbon::parse($request->start_date)->format('Y-m-d 00:00:00');
            $end = Carbon::parse($request->end_date)->format('Y-m-d 23:59:59');
            $status = $request->status_id;
            
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $start)->format('d/m/Y');
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $end)->format('d/m/Y');        
            
            $totalTicket = DB::table('ticket')->whereBetween('created_at', [$start, $end])->count();
            $pendingTicket = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', 1)->count();
            $attendingTicket = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', 2)->count();
            $finalizedTicket = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', 3)->count();
            $canceledTicket = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', 4)->count();

            $normalPriority = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('priority_id', 1)->count();
            $lowPriority = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('priority_id', 2)->count();
            $highPriority = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('priority_id', 3)->count();
    
            if($status > 0){
                $category = DB::table('ticket_category')
                            ->select(DB::raw('count(*) as amount, name'))
                            ->join('ticket', 'ticket.category_id', 'ticket_category.id')
                            ->whereBetween('ticket.created_at', [$start, $end])
                            ->where('ticket.status_id', $status)
                            ->groupBy('ticket_category.name')->get();  
                            
                $uncategory = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', $status)->where('category_id', null)->count();
                $untype = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', $status)->where('equipment_id', null)->count();
    
                $typeEquipment = DB::table('type_equipment')
                                ->select(DB::raw('count(*) as amount, type_equipment.name'))
                                ->join('equipment', 'equipment.type_id', 'type_equipment.id')
                                ->join('ticket', 'ticket.equipment_id', 'equipment.id')
                                ->whereBetween('ticket.created_at', [$start, $end])
                                ->where('ticket.status_id', $status)
                                ->groupBy('type_equipment.name')->get();
            } else {
                $category = DB::table('ticket_category')
                            ->select(DB::raw('count(*) as amount, name'))
                            ->join('ticket', 'ticket.category_id', 'ticket_category.id')
                            ->whereBetween('ticket.created_at', [$start, $end])
                            ->groupBy('ticket_category.name')->get();                    
                            
                $uncategory = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('category_id', null)->count();
                $untype = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('equipment_id', null)->count();
    
                $typeEquipment = DB::table('type_equipment')
                                ->select(DB::raw('count(*) as amount, type_equipment.name'))
                                ->join('equipment', 'equipment.type_id', 'type_equipment.id')
                                ->join('ticket', 'ticket.equipment_id', 'equipment.id')
                                ->whereBetween('ticket.created_at', [$start, $end])
                                ->groupBy('type_equipment.name')->get();
            }
            
            return view('report.period', ['totalTicket' => $totalTicket, 'pendingTicket' => $pendingTicket, 'attendingTicket' => $attendingTicket, 'finalizedTicket' => $finalizedTicket, 'canceledTicket' => $canceledTicket, 'normalPriority' => $normalPriority, 'lowPriority' => $lowPriority, 'highPriority' => $highPriority, 'category' => $category, 'typeEquipment' => $typeEquipment, 'startDate' => $startDate, 'endDate' => $endDate, 'start' => $start, 'end' => $end, 'status' => $status, 'uncategory' => $uncategory, 'untype' => $untype]);
        } else {
            abort(401);
        }        
    }

    public function showPeriodPrint(ReportPeriodRequest $request)
    {
        if(Auth::user()->type_id == 1){
            $start = Carbon::parse($request->start_date)->format('Y-m-d 00:00:00');
            $end = Carbon::parse($request->end_date)->format('Y-m-d 23:59:59');
            $status = $request->status_id;
            
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $start)->format('d/m/Y');
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $end)->format('d/m/Y');        
            
            $totalTicket = DB::table('ticket')->whereBetween('created_at', [$start, $end])->count();
            $pendingTicket = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', 1)->count();
            $attendingTicket = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', 2)->count();
            $finalizedTicket = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', 3)->count();
            $canceledTicket = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', 4)->count();
    
            $normalPriority = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('priority_id', 1)->count();
            $lowPriority = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('priority_id', 2)->count();
            $highPriority = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('priority_id', 3)->count();

            if($status > 0){
                $category = DB::table('ticket_category')
                            ->select(DB::raw('count(*) as amount, name'))
                            ->join('ticket', 'ticket.category_id', 'ticket_category.id')
                            ->whereBetween('ticket.created_at', [$start, $end])
                            ->where('ticket.status_id', $status)
                            ->groupBy('ticket_category.name')->get();                            
                
                $uncategory = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', $status)->where('category_id', null)->count();
                $untype = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('status_id', $status)->where('equipment_id', null)->count();

                $typeEquipment = DB::table('type_equipment')
                                ->select(DB::raw('count(*) as amount, type_equipment.name'))
                                ->join('equipment', 'equipment.type_id', 'type_equipment.id')
                                ->join('ticket', 'ticket.equipment_id', 'equipment.id')
                                ->whereBetween('ticket.created_at', [$start, $end])
                                ->where('ticket.status_id', $status)
                                ->groupBy('type_equipment.name')->get();
            } else {
                $category = DB::table('ticket_category')
                            ->select(DB::raw('count(*) as amount, name'))
                            ->join('ticket', 'ticket.category_id', 'ticket_category.id')
                            ->whereBetween('ticket.created_at', [$start, $end])
                            ->groupBy('ticket_category.name')->get();                            
                
                $uncategory = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('category_id', null)->count();
                $untype = DB::table('ticket')->whereBetween('created_at', [$start, $end])->where('equipment_id', null)->count();

                $typeEquipment = DB::table('type_equipment')
                                ->select(DB::raw('count(*) as amount, type_equipment.name'))
                                ->join('equipment', 'equipment.type_id', 'type_equipment.id')
                                ->join('ticket', 'ticket.equipment_id', 'equipment.id')
                                ->whereBetween('ticket.created_at', [$start, $end])
                                ->groupBy('type_equipment.name')->get();
            }
            
            return view('report.periodPrint', ['totalTicket' => $totalTicket, 'pendingTicket' => $pendingTicket, 'attendingTicket' => $attendingTicket, 'finalizedTicket' => $finalizedTicket, 'canceledTicket' => $canceledTicket, 'normalPriority' => $normalPriority, 'lowPriority' => $lowPriority, 'highPriority' => $highPriority, 'category' => $category, 'typeEquipment' => $typeEquipment, 'startDate' => $startDate, 'endDate' => $endDate, 'uncategory' => $uncategory, 'untype' => $untype]);
        } else {
            abort(401);
        }
    }

}