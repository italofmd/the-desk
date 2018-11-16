@extends('knowledge.layout') 
@section('title', 'Editar Categoria')
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
                    <h2><span class="icon-pages"></span>Editar categoria</h2>                    
                </header><br>
                <form action="{{ route('articleCategoryEdit', $category->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-5">                        
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('name') ? 'has-error' : '' }}">
                                <label for="name">Nome <span class="input-required">*</span></label>
                                <input class="form-control" type="text" maxlength="100" name="name" id="name"
                                    value="{{ $category->name }}" autofocus required>
                                @if(Session::get('errors'))
                                    <span class="error">{{  Session::get('errors')->first('name') }}</span>
                                @endif
                            </div>  
                        </div>        
                        <div class="col-sm-7">                        
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('description') ? 'has-error' : '' }}">
                                <label for="description">Descrição</label>
                                <input class="form-control" type="text" maxlength="200" name="description" id="description"
                                    value="{{ $category->description }}">
                                @if(Session::get('errors'))
                                    <span class="error">{{  Session::get('errors')->first('description') }}</span>
                                @endif
                            </div>  
                        </div>           
                    </div>               
                    <div class="button-group">
                        <button type="submit" class="btn btn-info">Salvar</button>
                        <a href="{{ route('articleCategoryIndex') }}">
                            <button type="button" class="btn btn-danger">Cancelar</button>
                        </a>
                    </div>
                </form>
            </div>            
            @include('knowledge.menu')            
        </div>
    </div>
</section>
@endsection