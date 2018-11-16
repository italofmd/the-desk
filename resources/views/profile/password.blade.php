@extends('layout.index')

@section('title', 'Alterar Senha')

@section('selector', 'Perfil')

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-title">
                    <h4>Alterar senha</h4>
                    <div class="border-title"></div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('profilePassword') }}" method="POST">
                            @csrf                            
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('password') ? 'has-error' : '' }}">
                                <label for="password">Nova senha <span class="input-required">*</span></label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                    name="password" required>                                
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

                            <div class="button-group">
                                <button type="submit" class="btn btn-info">Salvar</button>
                                <a href="{{ route('home') }}">
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