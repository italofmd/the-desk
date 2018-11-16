@extends('layout.index')

@section('title', 'Período')

@section('selector', 'Relatórios')

@section('content')
<div class="col-lg-10">
    <div class="card">
        <div class="card-title">
            <div class="float-right">
                <h6>{{ $startDate. ' - ' .$endDate }}</h6>
            </div>
            <h4>Tickets</h4>                        
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>                            
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Percentual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:50%;">Total</td>
                            <td>{{ $totalTicket }}</td>
                            @if($totalTicket > 0)
                                <td>{{ number_format(($totalTicket * 100) / $totalTicket, 2, '.', '') }}%</td>
                            @else 
                                <td>0%</td>
                            @endif
                        </tr>
                        <tr>
                            <td style="width:50%;">Abertos</td>
                            <td>{{ $pendingTicket }}</td>
                            @if($pendingTicket > 0)
                                <td>{{ number_format(($pendingTicket * 100) / $totalTicket, 2, '.', '') }}%</td>
                            @else 
                                <td>0%</td>
                            @endif
                        </tr>
                        <tr>
                            <td style="width:50%;">Atendendo</td>
                            <td>{{ $attendingTicket }}</td>
                            @if($attendingTicket > 0)
                                <td>{{ number_format(($attendingTicket * 100) / $totalTicket, 2, '.', '') }}%</td>
                            @else 
                                <td>0%</td>
                            @endif
                        </tr>
                        <tr>
                            <td style="width:50%;">Resolvidos</td>
                            <td>{{ $finalizedTicket }}</td>                            
                            @if($finalizedTicket > 0)
                                <td>{{ number_format(($finalizedTicket * 100) / $totalTicket, 2, '.', '') }}%</td>
                            @else 
                                <td>0%</td>
                            @endif
                        </tr>
                        <tr>
                            <td style="width:50%;">Cancelados</td>
                            <td>{{ $canceledTicket }}</td>                            
                            @if($canceledTicket > 0)
                                <td>{{ number_format(($canceledTicket * 100) / $totalTicket, 2, '.', '') }}%</td>
                            @else 
                                <td>0%</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-title">
            <h4>Prioridade</h4>            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>                            
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Percentual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:50%;">Baixa</td>
                            <td>{{ $lowPriority }}</td>
                            @if($lowPriority > 0)
                                <td>{{ number_format(($lowPriority * 100) / $totalTicket, 2, '.', '') }}%</td>
                            @else 
                                <td>0%</td>
                            @endif
                        </tr>
                        <tr>
                            <td style="width:50%;">Normal</td>
                            <td>{{ $normalPriority }}</td>
                            @if($normalPriority > 0)
                                <td>{{ number_format(($normalPriority * 100) / $totalTicket, 2, '.', '') }}%</td>
                            @else 
                                <td>0%</td>
                            @endif
                        </tr>
                        <tr>
                            <td style="width:50%;">Alta</td>
                            <td>{{ $highPriority }}</td>                            
                            @if($highPriority > 0)
                                <td>{{ number_format(($highPriority * 100) / $totalTicket, 2, '.', '') }}%</td>
                            @else 
                                <td>0%</td>
                            @endif
                        </tr>                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-title">
            <h4>Categorias</h4>            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>                            
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Percentual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($category->isNotEmpty() == true || $uncategory > 0)
                            @if($category->isNotEmpty() == true)
                                @foreach($category as $c)
                                <tr>
                                    <td style="width:50%;">{{ $c->name }}</td>
                                    <td>{{ $c->amount }}</td>                            
                                    @if($c->amount > 0)
                                        <td>{{ number_format(($c->amount * 100) / $totalTicket, 2, '.', '') }}%</td>
                                    @else 
                                        <td>0%</td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif
                            @if($uncategory > 0)
                                <tr>
                                <td style="width:50%;">Sem categoria</td>
                                <td>{{ $uncategory }}</td>                            
                                @if($uncategory > 0)
                                    <td>{{ number_format(($uncategory * 100) / $totalTicket, 2, '.', '') }}%</td>
                                @else 
                                    <td>0%</td>
                                @endif
                            </tr>
                            @endif
                        @else
                            <tr>
                                <td class="text-center" colspan="3">Nenhum registro encontrado</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-title">
            <h4>Equipamentos</h4>            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>                            
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Percentual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($typeEquipment->isNotEmpty() == true || $untype > 0)
                            @if($typeEquipment->isNotEmpty() == true)
                                @foreach($typeEquipment as $t)
                                <tr>
                                    <td style="width:50%;">{{ $t->name }}</td>
                                    <td>{{ $t->amount }}</td>                            
                                    @if($t->amount > 0)
                                        <td>{{ number_format(($t->amount * 100) / $totalTicket, 2, '.', '') }}%</td>
                                    @else 
                                        <td>0%</td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif
                            @if($untype > 0)
                                <tr>
                                <td style="width:50%;">Não informado</td>
                                <td>{{ $untype }}</td>                            
                                @if($untype > 0)
                                    <td>{{ number_format(($untype * 100) / $totalTicket, 2, '.', '') }}%</td>
                                @else 
                                    <td>0%</td>
                                @endif
                            </tr>
                            @endif
                        @else
                            <tr>
                                <td class="text-center" colspan="3">Nenhum registro encontrado</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="button-group">
        <form action="{{ route('reportPeriodPrint') }}" method="POST" target="_blank">
            @csrf
            <input type="hidden" name="start_date" value="{{ $start }}">
            <input type="hidden" name="end_date" value="{{ $end }}">
            <input type="hidden" name="status_id" value="{{ $status }}">
            <button type="submit" class="btn btn-info"><i class="fas fa-print"></i> Imprimir</button>        
        </form>
    </div>
</div>
@endsection