@extends('layout.index')

@section('title', 'Editar Equipamento')

@section('selector', 'Equipamentos')

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-title">
                    <h4>Editar equipamento</h4>
                    <div class="border-title"></div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('equipmentEdit', $equipment->id) }}" method="POST">
                            @csrf

                            @if(Auth::user()->type_id == 1)
                                <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('user_id') ? 'has-error' : '' }}">
                                    <label for="user_id">Proprietário <span class="input-required">*</span></label>
                                    <select class="form-control" name="user_id" id="user_id" required autofocus>
                                        <option value=""></option>
                                        @foreach($user as $u)
                                            <option value="{{ $u->id }}" {{ $equipment->user_id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                    @if(Session::get('errors'))
                                        <span class="form-control-feedback">{{  Session::get('errors')->first('user_id') }}</span>
                                    @endif
                                </div>
                            @endif                            
                            
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('name') ? 'has-error' : '' }}">
                                <label for="name">Nome <span class="input-required">*</span></label>
                                <input type="text" maxlength="50" name="name" id="name" class="form-control"
                                       value="{{ $equipment->name  }}" required>
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('name') }}</span>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('type_id') ? 'has-error' : '' }}">
                                        <label for="type_id">Tipo de equipamento</label>
                                        <select name="type_id" id="type_id" class="form-control">
                                            <option value=""></option>
                                            @foreach($typeEquipment as $t)
                                                <option value="{{ $t->id }}" {{ $equipment->type_id == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                                            @endforeach
                                        </select>
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('type_id') }}</span>
                                        @endif                                
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('manufacturer_id') ? 'has-error' : '' }}">
                                        <label for="manufacturer_id">Fabricante</label>
                                        <select name="manufacturer_id" id="manufacturer_id" class="form-control">
                                            <option value=""></option>
                                            @foreach($manufacturer as $m)
                                                <option value="{{ $m->id }}" {{ $equipment->manufacturer_id == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                                            @endforeach
                                        </select>
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('manufacturer_id') }}</span>
                                        @endif                                
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('model') ? 'has-error' : '' }}">
                                        <label for="model">Modelo</label>
                                        <input type="text" maxlength="30" name="model" id="model" class="form-control"
                                                value="{{ $equipment->model }}">
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('model') }}</span>
                                        @endif                                       
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('serial_number') ? 'has-error' : '' }}">
                                        <label for="serial_number">Número de série</label>
                                        <input type="text" maxlength="30" name="serial_number" id="serial_number" class="form-control"
                                                value="{{ $equipment->serial_number }}">
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('serial_number') }}</span>
                                        @endif                                    
                                    </div>
                                </div>
                            </div>         
                            
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('network_name') ? 'has-error' : '' }}">
                                        <label for="network_name">Nome de rede</label>
                                        <input class="form-control" type="text" maxlength="30" name="network_name" id="network_name" value="{{ $equipment->network_name }}">
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('network_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('tag_name') ? 'has-error' : '' }}">
                                        <label for="tag_name">Etiqueta</label>
                                        <input class="form-control" type="text" maxlength="30" name="tag_name" id="tag_name" value="{{ $equipment->tag_name }}">
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('tag_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('ip') ? 'has-error' : '' }}">
                                        <label for="ip">IP</label>
                                        <input class="form-control" type="text" maxlength="30" name="ip" id="ip" value="{{ $equipment->ip }}">
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('ip') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('note') ? 'has-error' : '' }}">
                                <label for="note">Especificações</label>
                                <textarea class="form-control" style="height: 100px;" name="note" id="note"maxlength="200">{{ $equipment->note }}</textarea>
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('note') }}</span>
                                @endif
                            </div>                                                    

                            <div class="button-group">
                                <button type="submit" class="btn btn-info">Salvar</button>
                                <a href="{{ route('equipmentIndex') }}">
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