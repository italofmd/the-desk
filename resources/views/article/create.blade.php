@extends('knowledge.layout') 
@section('title', 'Adicionar Artigo')
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
                    <h2><span class="icon-pages"></span>Adicionar artigo</h2>                    
                </header><br>
                <form action="{{ route('articleCreate') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-7">                        
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('title') ? 'has-error' : '' }}">
                                <label for="title">Título <span class="input-required">*</span></label>
                                <input class="form-control" type="text" maxlength="100" name="title" id="title"
                                    value="{{ old('title') }}" required>
                                @if(Session::get('errors'))
                                    <span class="error">{{  Session::get('errors')->first('title') }}</span>
                                @endif
                            </div>  
                        </div>        
                        <div class="col-sm-5">                        
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('category_id') ? 'has-error' : '' }}">
                                <label for="category_id">Categoria <span class="input-required">*</span></label>
                                <select class="form-control" name="category_id" id="category_id" required>
                                    <option></option>
                                    @foreach ($category as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>                                
                                    @endforeach
                                </select>
                                @if(Session::get('errors'))
                                    <span class="error">{{  Session::get('errors')->first('category_id') }}</span>
                                @endif
                            </div>  
                        </div>           
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('content') ? 'has-error' : '' }}">
                                <label for="content">Conteúdo <span class="input-required">*</span></label>
                                <textarea id="summernote" name="content"></textarea>
                                @if(Session::get('errors'))
                                    <span class="error">{{  Session::get('errors')->first('content') }}</span>
                                @endif
                            </div>                          
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn btn-info">Salvar</button>
                        <a href="{{ route('articleIndex') }}">
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