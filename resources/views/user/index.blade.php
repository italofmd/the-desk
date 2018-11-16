@extends('layout.index')

@section('title', 'Usuários')

@section('selector', 'Usuários')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Usuários</h4>
                    <h6 class="card-subtitle">Todos os usuários cadastrados</h6>              
                    <div class="table-responsive m-t-40">
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>                                    
                                    <th>Nome</th>
                                    <th>E-mail</th>                                    
                                    <th>Tipo</th>                                    
                                    <th class="text-right">Opções</th>                                 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $u)
                                    <tr>                                        
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>                                        
                                        <td>
                                            {{ $u->getTypeUser->name}}    
                                        </td>  
                                        <td class="text-right">                                            
                                            <a href="{{ route('userEdit', $u->id) }}" title="Editar usuário">
                                                <button type="button" class="btn btn-info btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm delete-confirm" 
                                                    {{ Auth::user()->id == $u->id ? 'disabled' : '' }} value="{{ route('userDelete', $u->id) }}" title="Excluir usuário">
                                                <i class="fa fa-trash"></i>
                                            </button>                                                                              
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