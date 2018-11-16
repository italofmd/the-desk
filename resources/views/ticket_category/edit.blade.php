@extends('layout.index')

@section('title', 'Editar Categoria')

@section('selector', 'Categorias')

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-title">
                    <h4>Editar categoria</h4>
                    <div class="border-title"></div>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('categoryEdit', $categoryItem->id) }}" method="POST">
                            @csrf
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('name') ? 'has-error' : '' }}">
                                <label for="name">Nome <span class="input-required">*</span></label>
                                <input type="text" maxlength="20" name="name" id="name" class="form-control"
                                       value="{{ $categoryItem->name }}" required autofocus>
                                @if(Session::get('errors'))
                                    <span class="form-control-feedback">{{  Session::get('errors')->first('name') }}</span>
                                @endif
                            </div>

                            <div class="button-group">
                                <button type="submit" class="btn btn-info">Salvar</button>
                                <a href="{{ route('categoryIndex') }}">
                                    <button type="button" class="btn btn-danger">Cancelar</button>
                                </a> 
                            </div>                                                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-title">
                    <h4>Categorias</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th class="text-right">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($category as $c)
                                <tr>
                                    <td>{{ $c->name }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('categoryEdit', $c->id) }}" title="Editar categoria">
                                            <button type="button" class="btn btn-info btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-confirm"
                                                value="{{ route('categoryDelete', $c->id) }}" title="Excluir categoria">
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