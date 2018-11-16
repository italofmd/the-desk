@extends('knowledge.layout') 
@section('title', 'Artigos') 
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
                    <h2><span class="icon-pages"></span>Artigos</h2>
                    <p>Todos os artigos cadastrados</p>
                </header><br>

                <div class="row">
                    <div class="col-sm-12">                        
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Categoria</th>
                                    <th class="text-right">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($article as $a)
                                    <tr>
                                        <td>{{ $a->title }}</td>
                                        <td>{{ $a->getCategory->name }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('articleEdit', $a->id) }}" title="Editar artigo">
                                                <button type="button" class="btn btn-info btn-sm"><i
                                                            class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm delete-confirm"
                                                    value="{{ route('articleDelete', $a->id) }}" title="Excluir artigo">
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