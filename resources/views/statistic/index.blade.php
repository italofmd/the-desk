@extends('layout.index') 

@section('title', 'Estatísticas') 

@section('selector', 'Estatísticas') 

@section('content')   

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Tickets</h4>
                    <div class="border-title"></div>
                </div>
                <div class="card-body">        
                    <div class="chart-content">
                        {!! $chartStatus->container() !!}    
                    </div>                    
                </div>                                    
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Prioridade</h4>
                    <div class="border-title"></div>
                </div>
                <div class="card-body">
                    <div class="chart-content">
                        {!! $chartPriority->container() !!}
                    </div>                    
                </div>                                    
            </div>
        </div>
    </div>    
    
    {!! $chartPriority->script() !!}
    {!! $chartStatus->script() !!}    
@endsection