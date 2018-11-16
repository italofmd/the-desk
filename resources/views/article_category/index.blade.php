@extends('knowledge.layout') 
@section('title', 'Categorias') 
@section('header')
<div class="masthead single-masthead">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form>
                    <input type="text" class="search-field" placeholder="Pesquisar algo ... " />
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>           
        </div>
    </div>
</div>
@endsection 
@section('content')
<section class="topics">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <header>
                    <h2><span class="icon-pages"></span>Categorias</h2>
                    <p>Todos as categorias cadastrados</p>
                </header><br>

                <div class="row">
                    <div class="col-sm-12">                        
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>                                    
                                    <th class="text-right">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $c)
                                    <tr>
                                        <td style="width: 80%;">{{ $c->name }}</td>                                        
                                        <td class="text-right">
                                            <a href="{{ route('articleCategoryEdit', $c->id) }}" title="Editar categoria">
                                                <button type="button" class="btn btn-info btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm delete-confirm"
                                                value="{{ route('articleCategoryDelete', $c->id) }}" title="Excluir categoria">
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
            @include('knowledge.menu')            
        </div>
    </div>
</section>
@endsection