@extends('layout.index')

@section('title', 'Cadastrar Usuário')

@section('selector', 'Usuários')

@section('content')

    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-title">
                    <h4>Cadastrar usuário</h4>
                    <div class="border-title"></div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('userCreate') }}" method="POST">
                            @csrf
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('name') ? 'has-error' : '' }}">
                                <label for="name">Nome <span class="input-required">*</span></label>
                                <input id="name" type="text" class="form-control" 
                                        name="name" value="{{ old('name') }}" required autofocus>
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('email') ? 'has-error' : '' }}">
                                <label for="email">E-mail <span class="input-required">*</span></label>
                                <input id="email" type="email" class="form-control" 
                                    name="email" value="{{ old('email') }}" required>
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('password') ? 'has-error' : '' }}">
                                <label for="password">Senha <span class="input-required">*</span></label>
                                <input id="password" type="password" class="form-control" name="password" required>            
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('password') }}</span>
                                @endif                    
                            </div> 

                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('password_confirmation') ? 'has-error' : '' }}">
                                <label for="password-confirm">Confirmar senha <span class="input-required">*</span></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('password_confirmation') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('type_id') ? 'has-error' : '' }}">
                                <label for="type_id">Tipo de usuário <span class="input-required">*</span></label>
                                <select name="type_id" id="type_id" class="form-control" required>   
                                    <option value=""></option>
                                    @foreach($typeUser as $t)
                                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('type_id') }}</span>
                                @endif
                            </div>                           

                            <div class="button-group">
                                <button type="submit" class="btn btn-info">Salvar</button>
                                <a href="{{ route('userIndex') }}">
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