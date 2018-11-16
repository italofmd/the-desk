@extends('layout.index')

@section('title', 'Abrir Ticket')

@section('selector', 'Tickets')

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-title">
                    <h4>Abrir ticket</h4>
                    <div class="border-title"></div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('ticketCreate') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(Auth::user()->type_id == 1)
                                <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('user_id') ? 'has-error' : '' }}">
                                    <label for="user_id">Usuário <span class="input-required">*</span></label>
                                    <select name="user_id" id="user_id" class="form-control" required autofocus>     
                                        <option value=""></option>
                                        @foreach($user as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                    @if(Session::get('errors'))
                                        <span class="form-control-feedback">{{  Session::get('errors')->first('user_id') }}</span>
                                    @endif
                                </div>
                            @endif

                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('equipment_id') ? 'has-error' : '' }}">
                                <label for="equipment_id">Equipamento</label>
                                @if(Auth::user()->type_id == 2)
                                    <select class="form-control" name="equipment_id" id="equipment_id" autofocus>
                                @else
                                    <select class="form-control" name="equipment_id" id="equipment_id">
                                @endif
                                    <option value=""></option>
                                    @foreach($equipment as $e)
                                        @if(Auth::user()->type_id == 1)
                                            <option value="{{ $e->id }}">{{ $e->name }} - {{ $e->getUser->name }}</option>
                                        @else
                                            <option value="{{ $e->id }}">{{ $e->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('equipment_id') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('subject') ? 'has-error' : '' }}">
                                <label for="subject">Assunto <span class="input-required">*</span></label>
                                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="form-control" maxlength="30" required>
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('subject') }}</span>
                                @endif
                            </div>                                                       
                            
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('priority_id') ? 'has-error' : '' }}">
                                <label for="priority_id">Prioridade <span class="input-required">*</span></label>
                                <select name="priority_id" id="priority_id" class="form-control" required>     
                                    <option value=""></option>
                                    @foreach($priority as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('priority_id') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('file') ? 'has-error' : '' }}">
                                <label for="file">Anexo</label>
                                <input type="file" name="file" id="file" class="form-control">    
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('file') }}</span>
                                @endif                                
                            </div>
                            
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('description') ? 'has-error' : '' }}">
                                <label for="description">Descrição <span class="input-required">*</span></label>
                                <textarea style="height: 100px;" maxlength="250" class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('description') }}</span>
                                @endif
                            </div>

                            <div class="button-group">
                                <button type="submit" class="btn btn-info">Salvar</button>
                                <a href="{{ route('ticketIndex') }}">
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