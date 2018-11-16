<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">    
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
        <title>The Desk | Período</title>    
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">        
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/lib/calendar2/semantic.ui.min.css') }}" rel="stylesheet">      
        <link href="{{ asset('css/helper.css') }}" rel="stylesheet">        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
        <!--[if lt IE 9]>
        <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
<body onload="window.print(); window.close();">

<div id="main-wrapper">            
    <div class="row">
        <div class="col-lg-12">

            <div class="print-header">
                <img src="{{ asset('images/login.png') }}" width="100">
                <h2 class="text-center">Tickets - Relatório por Período</h2>
                <h4 class="text-center">{{ $startDate }} - {{ $endDate }}</h4>                
            </div>

            <div class="card">
                <div class="card-title">
                    <h4>Tickets</h4>            
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
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
                        <table class="table table-bordered">
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

            @if($category->isNotEmpty() == true || $uncategory > 0)
                <div class="card">
                    <div class="card-title">
                        <h4>Categorias</h4>            
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>                            
                                        <th>Descrição</th>
                                        <th>Quantidade</th>
                                        <th>Percentual</th>
                                    </tr>
                                </thead>
                                <tbody>  
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @if($typeEquipment->isNotEmpty() == true || $untype > 0)
                <div class="card">
                    <div class="card-title">
                        <h4>Equipamentos</h4>            
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>                            
                                        <th>Descrição</th>
                                        <th>Quantidade</th>
                                        <th>Percentual</th>
                                    </tr>
                                </thead>
                                <tbody>  
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
                                </tbody>
                            </table>
                        </div>
                    </div>        
                </div>
            @endif

        </div>                
    </div>       
</div>

<script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/lib/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('js/lib/bootstrap/js/bootstrap.min.js') }}"></script>

</body>

</html>