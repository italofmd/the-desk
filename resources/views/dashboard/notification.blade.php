@extends('layout.index') 
@section('title', 'Notificações') 
@section('selector', 'Notificações') 
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-title">
                <h4>@yield('title')</h4>
                <div class="border-title"></div>
            </div>
            <div class="card-body">
                <div class="recent-comment">
                    @if($messages)
                        @foreach($messages as $key => $m)
                            <div class="media {{ $loop->last ? 'no-border' : '' }}">
                                <div class="media-left">
                                    @if($m['image'] != null)
                                        <a href="{{ route('ticketView', $m['id']) }}"><img src="{{ asset('storage/profile/' . $m['image']) }}" alt="{{ $m['user'] }}" class="media-object"/></a>
                                    @else
                                        <a href="{{ route('ticketView', $m['id']) }}"><img src="{{ asset('images/user-default.jpg') }}" alt="{{ $m['user'] }}" class="media-object"/></a>
                                    @endif                                    
                                </div>
                                <div class="media-body">
                                    <a href="{{ route('ticketView', $m['id']) }}"><h4 class="media-heading">{{ $m['user'] }}</h4></a>
                                    <p>{{ $m['message'] }}</p>
                                    <div class="comment-date">{{ $m['date'] }}</div>                                    
                                </div>
                            </div>
                        @endforeach
                    @else 
                        <p class="text-center">Nenhuma notificação recente</p>
                    @endif                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection