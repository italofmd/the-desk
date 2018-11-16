@extends('layout.index')

@section('title', 'Dashboard')

@section('selector', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card p-30">
            <div class="media">
                <div class="media-left meida media-middle">
                    <span>
                        <i class="fa fa-calendar-plus-o f-s-40 color-primary"></i>
                    </span>
                </div>
                <div class="media-body media-text-right">
                    <h2>{{ $ticketToday }}</h2>
                    <p class="m-b-0">Tickets hoje</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-30">
            <div class="media">
                <div class="media-left meida media-middle">
                    <span>
                        <i class="fas fa-calendar-alt f-s-40 color-danger"></i>
                    </span>
                </div>
                <div class="media-body media-text-right">
                    <h2>{{ $ticketMonth }}</h2>
                    <p class="m-b-0">Tickets no mês</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-30">
            <div class="media">
                <div class="media-left meida media-middle">
                    <span>
                        <i class="fa fa-calendar-o f-s-40 color-warning"></i>
                    </span>
                </div>
                <div class="media-body media-text-right">
                    <h2>{{ $ticketTotal }}</h2>
                    <p class="m-b-0">Total de tickets</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-30">
            <div class="media">
                <div class="media-left meida media-middle">
                    <span>
                        <i class="fa fa-calendar-check-o f-s-40 color-success"></i>
                    </span>
                </div>
                <div class="media-body media-text-right">
                    <h2>{{ $ticketResolved }}</h2>
                    <p class="m-b-0">Tickets resolvidos</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tickets pendentes</h4>
                <h6 class="card-subtitle">Todos os tickets não resolvidos</h6>
                <div class="table-responsive m-t-40">
                    <table id="tickets" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Assunto</th>
                                @if(Auth::user()->type_id == 1)
                                    <th>Usuário</th>
                                @endif                                
                                <th>Data</th>
                                <th>Prioridade</th>
                                <th>Atendente</th>
                                <th class="text-right">Opções</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach($ticket as $t)
                                <tr>
                                    <td>{{ $t->getIdFormatted() }}</td>
                                    <td>
                                        <span class="badge text-white {{ $t->getStatusBadge() }}">
                                            {{ $t->getStatus->name }}
                                        </span>
                                    </td>
                                    <td>{{ $t->subject }}</td>
                                    @if(Auth::user()->type_id == 1)
                                        <td>{{ $t->getUser->name }}</td>
                                    @endif                                                                                                        
                                    <td>{{ $t->getCreatedAtFormatted() }}</td>
                                    <td>{{ $t->getPriority->name }}</td>
                                    <td>{{ $t->getAgentFormatted() }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('ticketView', $t->id) }}" title="Abrir ticket">
                                            <button type="button" class="btn btn-info btn-sm"><i class="fas fa-external-link-alt"></i></button>
                                        </a>                                        
                                        @if(Auth::user()->type_id == 1)
                                            <button type="button" class="btn btn-danger btn-sm delete-confirm"
                                                    value="{{ route('ticketDelete', $t->id) }}" title="Excluir ticket">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>                                                         
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection