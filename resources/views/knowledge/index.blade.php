@extends('knowledge.layout') 
@section('title', 'Base de Conhecimento') 
@section('header')
<div class="masthead text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Base de Conhecimento</h1>
                <p class="lead text-muted">Explore artigos que podem úteis para você
                </p>
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
            <div class="col-lg-12">
                <header>
                    <h2><span class="icon-pages"></span>Explorar artigos</h2>
                    <p>Fizemos o nosso melhor para cobrir todos os artigos de acordo com a sua necessidade. Cada seção possui
                        números que representam o número de artigos em cada categoria</p>
                </header>
                <div class="row">
                    @foreach($category as $c)
                        <div class="col-sm-4">
                            <div class="topics-list">
                                <h3><a href="#"><span class="badge">{{ $c['count'] }}</span>{{ $c['name'] }}</a></h3>
                                <ul>
                                    @foreach($article as $a)
                                        @if($a->category_id == $c['id'])
                                            <li><a href="#">{{ $a->title }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach 
                </div>
            </div>
            <div class="topics-btn text-center">
                <a class="btn btn-default" href="#"><span class="icon-adn"></span> Explorar todos</a>
            </div>
        </div>
    </div>
</section>

<section class="support-section text-white section">
    <div class="container">
        <div class="row">
            <div class="divider"><i class="fa fa-support"></i></div>
            <header class="text-center">
                <h2 class="section-title">Obtenha suporte de pessoas reais</h2>
                <p class="section-subtitle">Quando você estiver preso em algo, não perca seu tempo, deixe-nos saber que estamos aqui para ajudá-lo</p>
            </header>            
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row call-to-action">
            <div class="col-lg-1">
                <span class="icon icon-envelope"></span>
            </div>
            <div class="col-lg-9">
                <h3>Contato</h3>
                <p>Se você precisa de algo que está além desta base de conhecimento, você pode abrir um ticket para entrar em
                    contato conosco.</p>
            </div>
            <div class="col-lg-2">
                <a href="{{ route('ticketCreate') }}" class="btn btn-success btn-action">Abrir ticket</a>
            </div>
        </div>
    </div>
</section>
@endsection