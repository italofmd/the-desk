<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TicketRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\TicketUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Notifications\CreateTicket;
use App\Notifications\UpdateTicket;
use App\Notifications\SaveMessage;
use Carbon\Carbon;
use App\Priority;
use App\Equipment;
use App\Ticket;
use App\Message;
use App\TicketCategory;
use App\Status;
use App\User;

class TicketController extends Controller
{
    
    protected $equipment;
    protected $priority;
    protected $ticket;
    protected $message;
    protected $category;
    protected $status;
    protected $user;

    public function __construct(Equipment $equipment, Priority $priority, Ticket $ticket, Message $message, TicketCategory $category, Status $status, User $user)
    {        
        $this->equipment = $equipment;
        $this->priority = $priority;
        $this->ticket = $ticket;
        $this->message = $message;
        $this->category = $category;
        $this->status = $status;
        $this->user = $user;
    }

    public function showIndex()
    {                  
        if (Auth::user()->type_id == 1) {        
            $ticket = $this->ticket->all();
        } else {
            $ticket = $this->ticket->all()->where('user_id', Auth::user()->id);
        }

        return view('ticket.index')->with(compact('ticket'));
    }

    public function showCreate()
    {                                
        if (Auth::user()->type_id == 1) {            
            $equipment = $this->equipment->all();
        } else {
            $equipment = $this->equipment->all()->where('user_id', Auth::user()->id);
        }        
                
        $user = $this->user->all()->where('id', '!=', 1)->where('id', '!=', Auth::user()->id);
        $priority = $this->priority->all();

        return view('ticket.create')->with(compact('equipment'))->with(compact('priority'))->with(compact('user'));
    }

    public function saveCreate(TicketRequest $request)
    {        
        $data = [            
            'subject' => upperFirst($request->subject),
            'description' => upperFirst($request->description),
            'priority_id' => $request->priority_id,
            'status_id' => 1,
            'equipment_id' => $request->equipment_id,
            'category_id' => $request->category_id            
        ];

        if(Auth::user()->type_id == 1){
            $data += [
                'user_id' => $request->user_id
            ];
        } else {
            $data += [
                'user_id' => Auth::user()->id
            ];
        }
        
        if($request->hasFile('file')){
            $data += [
                'path' => $request->file->store('public/ticket'),
                'file' => $request->file->hashName(),
                'file_name' => $request->file->getClientOriginalName()                
            ];
            
        }

        $ticket = $this->ticket->create($data);        

        $dataMessage = [
            'message' => upperFirst($ticket->description),
            'ticket_id' => $ticket->id,
            'user_id' => $ticket->user_id
        ];

        $message = $this->message->create($dataMessage);
        
        $user = $this->user->findOrFail($ticket->user_id);        
        $user->notify(new CreateTicket($ticket));

        $notification = array(
            'message' => 'Ticket aberto com sucesso',
            'alert-type' => 'success'              
        );            
        
        return redirect()->route('ticketIndex')->with($notification);        
    }

    public function saveDelete($id)
    {        
        if(Auth::user()->type_id == 1){
            $ticket = $this->ticket->findOrFail($id);
            Storage::delete($ticket->path);
            $ticket->delete();

            $notification = array(
                'message' => 'Ticket apagado com sucesso',
                'alert-type' => 'success'
            );

            return redirect()->route('ticketIndex')->with($notification);
        } else {
            abort(401);
        }
    }

    public function showView($id)
    {   
        $ticket = $this->ticket->findOrFail($id);
        
        if (Auth::user()->type_id == 2 && $ticket->user_id != Auth::user()->id) {
            abort(404);
        }

        DB::table('message')->where('ticket_id', $id)->where('user_id', '!=', Auth::user()->id)->update(['read' => true]);

        $message = $this->message->all()->where('ticket_id', $id)->sortByDesc('id');
        $category = $this->category->all();
        $status = $this->status->all();
        
        Carbon::setLocale('pt-BR');
        
        foreach($message as $key => $m){
            
            $date = Carbon::parse($m->created_at);

            $dataMessage[$key] = [
                'name' => $m->getUser->name,
                'message' => $m->message,
                'date' => $date->diffForHumans(),
                'image' => $m->getUser->getProfile->file
            ];
        }
        
        return view('ticket.view')->with(compact('ticket'))->with(compact('dataMessage'))->with(compact('category'))->with(compact('status'));
    }    

    public function saveMessage(MessageRequest $request)
    {        
        $data = [
            'message' => $request->message,
            'ticket_id' => $request->id,
            'user_id' => Auth::user()->id
        ];

        $message = $this->message->create($data);

        if(Auth::user()->type_id == 1){            
            $message = $this->message->findOrFail($message->id);
            $ticket = $this->ticket->findOrFail($message->getTicket->id);
            $user = $this->user->findOrFail($ticket->user_id);

            $user->notify(new SaveMessage($ticket, $message));
        }

        $notification = array(
            'message' => 'Mensagem enviada com sucesso',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }    

    public function saveUpdate(TicketUpdateRequest $request)
    {
        if(Auth::user()->type_id == 1){            
            $ticket = $this->ticket->findOrFail($request->id);                                            

            $data = [
                'category_id' => $request->category_id,                
                'status_id' => $request->status_id
            ];

            if($ticket->agent_id == null){
                $data['agent_id'] = Auth::user()->id;
            }

            if($request->status_id == 3){
                $data['conclusion_date'] = Carbon::now()->format('Y-m-d H:i:s');
            } else {
                $data['conclusion_date'] = null;
            }

            $ticket->update($data);
            $ticket->save();

            $user = $this->user->findOrFail($ticket->user_id);        
            $user->notify(new UpdateTicket($ticket));

            $notification = array(
                'message' => 'Ticket atualizado com sucesso',
                'alert-type' => 'success'
            );
                
            return redirect()->back()->with($notification);
        } else {
            abort(401);
        }
    }

}