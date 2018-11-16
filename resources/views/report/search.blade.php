@extends('layout.index')

@section('title', 'Período')

@section('selector', 'Relatórios')

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-title">
                <h4>@yield('title')</h4>
                <div class="border-title"></div>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('reportPeriod') }}" method="POST">
                        @csrf
                                                
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('start_date') ? 'has-error' : '' }}">
                                    <label for="start_date">Início <span class="input-required">*</span></label>
                                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="form-control">
                                    @if(Session::get('errors'))
                                        <span class="form-control-feedback">{{  Session::get('errors')->first('start_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('end_date') ? 'has-error' : '' }}">
                                    <label for="end_date">Término <span class="input-required">*</span></label>
                                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="form-control">
                                    @if(Session::get('errors'))
                                        <span class="form-control-feedback">{{  Session::get('errors')->first('end_date') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('status_id') ? 'has-error' : '' }}">
                                    <label for="status_id">Tickets <span class="input-required">*</span></label>
                                    <select class="form-control" name="status_id" id="status_id" required>
                                        <option value="0">Todos</option>
                                        @foreach($status as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach                                        
                                    </select>
                                    @if(Session::get('errors'))
                                        <span class="form-control-feedback">{{  Session::get('errors')->first('status_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn btn-info">Confirmar</button>
                            <a href="{{ route('reportIndex') }}">
                                <button type="button" class="btn btn-danger">Cancelar</button>
                            </a>
                        </div>                            
                    </form>
                </div>
            </div>
        </div>         
    </div>
</div>
@endsection