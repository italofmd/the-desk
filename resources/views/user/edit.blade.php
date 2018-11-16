@extends('layout.index')

@section('title', 'Editar Usuário')

@section('selector', 'Usuário')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-title">
                    <h4>Editar usuário</h4>
                    <div class="border-title"></div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('userEdit', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-title"><h4><i class="far fa-file-alt">&nbsp</i>Informações básicas</h4></div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('name') ? 'has-error' : '' }}">
                                        <label for="name">Nome <span class="input-required">*</span></label>
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('email') ? 'has-error' : '' }}">
                                        <label for="email">E-mail <span class="input-required">*</span></label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>                                
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>                            

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('cpf') ? 'has-error' : '' }}">
                                        <label for="cpf">CPF</label>
                                        <input id="cpf" type="text" class="form-control mask-cpf" name="cpf" value="{{ $user->getProfile->cpf }}">                                
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('cpf') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('gender_id') ? 'has-error' : '' }}">
                                        <label for="gender_id">Sexo</label>
                                        <select style="height: 42px;" class="form-control" name="gender_id" id="gender_id">
                                            <option value=""></option>
                                            @foreach($gender as $g)
                                                <option value="{{ $g->id }}" {{ $user->getProfile->gender_id == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
                                            @endforeach
                                        </select>
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('gender_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('marital_id') ? 'has-error' : '' }}">
                                        <label for="marital_id">Estado civil</label>
                                        <select style="height: 42px;" class="form-control" name="marital_id" id="marital_id">      
                                            <option value=""></option>
                                            @foreach($marital as $m)
                                                <option value="{{ $m->id }}" {{ $user->getProfile->marital_id == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                                            @endforeach                                            
                                        </select>
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('marital_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>     
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('file') ? 'has-error' : '' }}">
                                        <label for="file">Foto de perfil</label>
                                        <input type="file" id="file" class="form-control" name="file">                                
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('file') }}</span>
                                        @endif
                                    </div>
                                </div>                                
                            </div>                       

                            <div class="form-title"><h4><i class="fas fa-map-marker-alt">&nbsp</i>Endereço e localização</h4></div>
                            <div class="row">  
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('zipcode') ? 'has-error' : '' }}">
                                        <label for="zipcode">CEP</label>
                                        <input id="zipcode" type="text" class="form-control mask-zipcode" name="zipcode" value="{{ $user->getProfile->zipcode }}">                                
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('zipcode') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('state_id') ? 'has-error' : '' }}">
                                        <label for="state_id">Estado</label>
                                        <select style="height: 42px;" class="form-control" name="state_id" id="state_id">
                                            <option value=""></option>
                                            @foreach($state as $s)
                                                <option value="{{ $s->id }}" {{ $user->getProfile->getStateIdFormatted() == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('state_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('city') ? 'has-error' : '' }}">
                                        <label for="city">Cidade</label>
                                        <select style="height: 42px;" class="form-control" name="city_id" id="city_id" {{ $user->getProfile->city_id == null ? 'disabled' : '' }}>
                                            <option value=""></option>
                                            @if($user->getProfile->city_id != null)
                                                @foreach($city as $c)
                                                    <option value="{{ $c->id }}" {{ $user->getProfile->city_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('city') }}</span>
                                        @endif
                                    </div>
                                </div>                                
                            </div>                            
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('neighborhood') ? 'has-error' : '' }}">
                                        <label for="neighborhood">Bairro</label>
                                        <input id="neighborhood" type="text" class="form-control" name="neighborhood" maxlength="50" value="{{ $user->getProfile->neighborhood }}">
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('neighborhood') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('street') ? 'has-error' : '' }}">
                                        <label for="street">Rua/Avenida</label>
                                        <input id="street" type="text" class="form-control" name="street" maxlength="100" value="{{ $user->getProfile->street }}">                                
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('street') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('number') ? 'has-error' : '' }}">
                                        <label for="number">Número</label>
                                        <input id="number" type="number" class="form-control" min="1" name="number" maxlength="5" value="{{ $user->getProfile->number }}">                                
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('number') }}</span>
                                        @endif
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">                            
                                <div class="col-lg-12">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('complement') ? 'has-error' : '' }}">
                                        <label for="complement">Complemento</label>
                                        <input id="complement" type="text" class="form-control" name="complement" maxlength="100" value="{{ $user->getProfile->complement }}">                                
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('complement') }}</span>
                                        @endif
                                    </div>
                                </div>                                
                            </div>

                            <div class="form-title"><h4><i class="far fa-envelope">&nbsp</i>Informações de contato</h4></div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('telephone') ? 'has-error' : '' }}">
                                        <label for="telephone">Telefone</label>
                                        <input id="telephone" type="text" class="form-control mask-telephone" name="telephone" value="{{ $user->getProfile->telephone }}">                                
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('telephone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('cellphone') ? 'has-error' : '' }}">
                                        <label for="cellphone">Celular</label>
                                        <input id="cellphone" type="text" class="form-control mask-cellphone" name="cellphone" value="{{ $user->getProfile->cellphone }}">                                
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('cellphone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('whatsapp') ? 'has-error' : '' }}">
                                        <label for="whatsapp">WhatsApp</label>
                                        <input id="whatsapp" type="text" class="form-control mask-cellphone" name="whatsapp" value="{{ $user->getProfile->whatsapp }}">                                
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('whatsapp') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-title"><h4><i class="fas fa-lock"></i>&nbsp</i>Informações de acesso</h4></div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('password') ? 'has-error' : '' }}">
                                        <label for="password">Senha</label>
                                        <input id="password" type="password" class="form-control" name="password">
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('password') }}</span>
                                        @endif                    
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('password_confirmation') ? 'has-error' : '' }}">
                                        <label for="password-confirm">Confirmar senha</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('type_id') ? 'has-error' : '' }}">
                                        <label for="type_id">Tipo de usuário <span class="input-required">*</span></label>
                                        <select name="type_id" id="type_id" class="form-control" required>
                                            <option value=""></option>
                                            @foreach($typeUser as $t)
                                                <option value="{{ $t->id }}" {{ $user->type_id == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                                            @endforeach
                                        </select>
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('type_id') }}</span>
                                        @endif
                                    </div>
                                </div>
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