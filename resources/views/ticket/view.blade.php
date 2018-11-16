@extends('layout.index')

@section('title', 'Visualizar Ticket')

@section('selector', 'Tickets')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-two">
                    <div class="title">
                        <h4>Ticket {{ $ticket->getIdFormatted() }}
                            <p class="{{ $ticket->getStatusColor() }}">{{ $ticket->getStatusFormatted() }}</p>                            
                        </h4>
                    </div>
                    <header>
                        <div class="avatar">
                            @if($ticket->getUser->getProfile->file != null)
                                <img src="{{ asset('storage/profile/' . $ticket->getUser->getProfile->file) }}" alt="{{ $ticket->getUser->getNameFormatted() }}" />
                            @else
                                <img src="{{ asset('images/user-default.jpg') }}" alt="{{ $ticket->getUser->getNameFormatted() }}" />
                            @endif
                        </div>
                    </header>
                    <h3>{{ $ticket->getUser->getNameFormatted() }}</h3>
                    <div class="desc">
                        "{{ $ticket->subject }}"<br>
                        <p>Data da solicitação: {{ $ticket->getCreatedAtFormatted() }}</p>                        
                    </div>                       
                </div>
            </div>
        </div>
    </div>    
    
    <div class="col-lg-12">
        <div class="card">            
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#conversation" role="tab">Conversas</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ticket" role="tab">Ticket</a></li>
                @if(Auth::user()->type_id == 1)
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#update" role="tab">Atualizar</a></li>
                @endif
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active" id="conversation" role="tabpanel">                    
                    <div class="card-body">
                        <br>
                        <div class="profiletimeline">      
                            @foreach($dataMessage as $m) 
                                @if($loop->iteration != 1)
                                    <hr>
                                @endif                           
                                <div class="sl-item">
                                    @if($m['image'] != null)
                                        <div class="sl-left"> 
                                            <img src="{{ asset('storage/profile/' . $m['image']) }}" alt="{{ $m['name'] }}" class="img-circle" /> 
                                        </div>
                                    @else
                                        <div class="sl-left"> 
                                            <img src="{{ asset('images/user-default.jpg') }}" alt="{{ $m['name'] }}" class="img-circle" /> 
                                        </div>
                                    @endif
                                    
                                    <div class="sl-right">
                                        <div><a href="#" class="link">{{ $m['name'] }}</a> <span class="sl-date">{{ $m['date'] }}</span>
                                            <p class="m-t-10">{{ $m['message'] }}</p>
                                        </div>
                                    </div>
                                </div>                                
                            @endforeach                            
                        </div>                                                         
                        <form action="{{ route('messageCreate', $ticket->id) }}" method="POST" class="form-horizontal form-material">
                            @csrf
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('message') ? 'has-error' : '' }}">                                
                                <div class="col-md-12">
                                    <textarea style="height: 100px;" maxlength="250" class="form-control form-control-line" id="message" name="message" rows="3" placeholder="Digite sua mensagem" required></textarea>                                    
                                    @if(Session::get('errors'))
                                        <span class="form-control-feedback">{{  Session::get('errors')->first('message') }}</span>
                                    @endif
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-info">Enviar Mensagem</button>
                                </div>
                            </div>
                        </form>                                                                                                                            
                    </div>
                </div>
                
                <div class="tab-pane" id="ticket" role="tabpanel">
                    <div class="card-body">
                        <br>
                        <div class="row">                                                      
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Equipamento</strong>
                                <br>
                                <p class="text-muted">{{ $ticket->getEquipmentFormatted() }}</p>
                            </div>                                                        
                            <div class="col-md-3 col-xs-6"> <strong>Prioridade</strong>
                                <br>
                                <p class="text-muted">{{ $ticket->getPriority->name }}</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Anexo</strong>
                                <br>
                                @if($ticket->file_name != null)
                                    <a class="text-info link" href="{{ asset('storage/ticket/' . $ticket->file) }}" target="_blank">{{ $ticket->file_name }}</a>
                                @else
                                    <p class="text-muted">Nenhum arquivo</p>
                                @endif
                            </div>
                            @if($ticket->conclusion_date == null)
                                <div class="col-md-3 col-xs-6 b-r"> <strong>Última atualização</strong>
                                    <br>
                                    <p class="text-muted">{{ $ticket->getUpdatedAtFormatted() }}</p>
                                </div>
                            @else
                                <div class="col-md-3 col-xs-6 b-r"> <strong>Data de conclusão</strong>
                                    <br>
                                    <p class="text-muted">{{ $ticket->getConclusionDateFormatted() }}</p>
                                </div>
                            @endif
                        </div>
                        <hr>
                        <h4 class="font-medium m-t-30">Descrição</h4>
                        <p class="m-t-30">                            
                            {{ $ticket->description }}
                        </p>                        
                        <br>                        
                    </div>
                </div>        
                
                @if(Auth::user()->type_id == 1)
                    <div class="tab-pane" id="update" role="tabpanel">
                        <div class="card-body">                        
                            <br>
                            <div class="row">  
                                <div class="col-md-12">
                                    <form action="{{ route('ticketUpdate', $ticket->id) }}" method="POST" class="form-horizontal form-material">
                                        @csrf                                                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="category_id">Categoria</label>
                                                <select class="form-control" name="category_id" id="category_id">
                                                    <option value="">Sem categoria</option>
                                                    @foreach($category as $c)
                                                        <option value="{{ $c->id }}" {{ $ticket->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                                    @endforeach
                                                </select>                                            
                                            </div>
                                        </div>                                    
                                        <div class="col-md-4">
                                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('status_id') ? 'has-error' : '' }}">
                                                <label for="status_id">Status <span class="input-required">*</span></label>
                                                <select name="status_id" id="status_id" class="form-control" required>      
                                                    <option value="">Selecionar status</option>
                                                    @foreach($status as $s)
                                                        <option value="{{ $s->id }}" {{ $ticket->status_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if(Session::get('errors'))
                                                    <span class="form-control-feedback">{{  Session::get('errors')->first('status_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-info">Atualizar ticket</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>                        
                        </div>
                    </div>        
                @endif
            </div>
        </div>
    </div>    
</div>
@endsection