@extends('layout.index')

@section('title', 'Tickets')

@section('selector', 'Tickets')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@yield('title')</h4>
                <h6 class="card-subtitle">Todos os tickets cadastrados</h6>
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
                                        <td>{{ $t->getUser->getNameFormatted() }}</td>
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