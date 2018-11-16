<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">    
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <title>The Desk | @yield('title')</title>    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/toastr/toastr.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/calendar2/semantic.ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header fix-sidebar">

<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>

<div id="main-wrapper">
    <div class="header">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">            
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('home') }}">                                       
                   <b><img src="{{ asset ('images/logo.png') }}" width="40" alt="homepage" class="dark-logo" /></b>                   
                   <span><img src="{{ asset ('images/text.png') }}" width="70" alt="homepage" class="dark-logo" /></span>
                </a>
            </div>
            
            <div class="navbar-collapse">                
                <ul class="navbar-nav mr-auto mt-md-0">                    
                    <li class="nav-item">
                        <a class="nav-link nav-toggler hidden-md-up text-muted" href="javascript:void(0)">
                            <i class="mdi mdi-menu"></i>
                        </a>
                    </li>
                    <li class="nav-item m-l-10">
                        <a class="nav-link sidebartoggler hidden-sm-down text-muted" href="javascript:void(0)">
                            <i class="ti-menu"></i>
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav my-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-bell"></i>
                            @if($messages)
                                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right mailbox">
                            <ul>
                                <li>
                                    <div class="drop-title">Notificações</div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        @if($messages)
                                            @foreach($messages as $m)
                                                <a href="{{ route('ticketView', $m['id']) }}">
                                                    <div class="btn {{ $m['color'] }} btn-circle m-r-10"><i class="fa fa-ticket-alt"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>{{ $m['user'] }}</h5> <span class="mail-desc">{{ $m['message'] }}</span> <span class="time">{{ $m['date'] }}</span>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else 
                                            <p class="text-center">Nenhuma notificação recente</p>
                                        @endif                                        
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link text-center" href="{{ route('notification') }}"><strong>Ver todas as notificações</strong> <i class="fa fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user()->getProfile->file != null)
                                <img style="margin-bottom: 7px; margin-right: 2px;" src="{{ asset('storage/profile/' . Auth::user()->getProfile->file) }}" alt="{{ Auth::user()->name }}" class="profile-pic"/>
                            @else
                                <img style="margin-bottom: 7px; margin-right: 2px;" src="{{ asset('images/user-default.jpg') }}" alt="{{ Auth::user()->name }}" class="profile-pic"/>
                            @endif
                            {{ Auth::user()->getNameFormatted() }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="dropdown-user">
                                <li>
                                    <a href="{{ route('profileEdit') }}">
                                        <i class="ti-user"> </i> Editar perfil</a>
                                </li>
                                <li>
                                    <a href="{{ route('profilePassword') }}">
                                        <i class="ti-lock"> </i> Alterar senha</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="ti-shift-right"> </i> Sair</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    
    <div class="left-sidebar">        
        <div class="scroll-sidebar">            
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-devider"></li>
                    <li class="nav-label">Home</li>
                    <li>
                        <a class="has-arrow" href="#" aria-expanded="false">
                            <i class="fa fa-tachometer-alt"></i>
                            <span class="hide-menu">Dashboard      
                                @if($ticketPending > 0)                          
                                    <span class="label label-rouded label-primary pull-right">
                                        {{ $ticketPending }}
                                    </span>
                                @endif
                            </span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li>
                                <a href="{{ route('home') }}">Tickets pendentes</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="#" aria-expanded="false">
                            <i class="fa fa-ticket-alt"></i>
                            <span class="hide-menu">Tickets</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li>
                                <a href="{{ route('ticketCreate') }}">Abrir ticket</a>
                                <a href="{{ route('ticketIndex') }}">Todos os tickets</a>
                            </li>
                        </ul>
                    </li>

                    @if(Auth::user()->type_id == 1)
                        <li>
                            <a href="{{ route('categoryIndex') }}" aria-expanded="false">
                                <i class="fa fa-layer-group"></i>
                                <span class="hide-menu">Categorias</span>
                            </a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('knowledge') }}" target="_blank" aria-expanded="false">
                            <i class="far fa-lightbulb"></i>
                            <span class="hide-menu">Base de conhecimento</span>
                        </a>                       
                    </li>

                    @if(Auth::user()->type_id == 1)
                        <li class="nav-label">Relatórios</li>
                        <li>
                            <a href="{{ route('statisticIndex') }}" aria-expanded="false">
                                <i class="fa fa-chart-line"></i>
                                <span class="hide-menu">Estatísticas</span>
                            </a>                       
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <i class="fa fa-chart-bar"></i>
                                <span class="hide-menu">Relatórios</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="{{ route('reportIndex') }}">Geral</a>
                                    <a href="{{ route('reportPeriod') }}">Período</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(Auth::user()->type_id == 1)
                        <li class="nav-label">Autenticação</li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <i class="fa fa-user-alt"></i>
                                <span class="hide-menu">Usuários</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="{{ route('userCreate') }}">Cadastrar</a>
                                    <a href="{{ route('userIndex') }}">Todos os usuários</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    
                    <li class="nav-label">Equipamentos</li>
                    <li>
                        <a class="has-arrow" href="#" aria-expanded="false">
                            <i class="fa fa-desktop"></i>
                            <span class="hide-menu">Equipamentos</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li>
                                <a href="{{ route('equipmentCreate') }}">Cadastrar</a>
                                <a href="{{ route('equipmentIndex') }}">Todos os equipamentos</a>
                            </li>
                        </ul>
                    </li>                                      
                </ul>
            </nav>            
        </div>        
    </div>
    
    <div class="page-wrapper">        
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">@yield('selector')</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <div class="selector">
                            <a href="{{ route('home') }}">Home</a>
                        </div>
                    </li>
                    <li class="breadcrumb-item active">@yield('selector')</li>
                </ol>
            </div>
        </div>        
        
        <div class="container-fluid">        
            @yield('content')
        </div>
        
        <footer class="footer"> © 2018 Todos os direitos reservados. Desenvolvido por
            <a href="https://italodeveloper.com.br" target="_blank">Ítalo Developer</a>
        </footer>        
    </div>    
</div>

<script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/lib/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/lib/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/lib/datatables/datatables-init.js') }}"></script>
<script src="{{ asset('js/lib/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/lib/toastr/toastr.init.js') }}"></script>
<script src="{{ asset('js/lib/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/lib/echart/echarts-en.min.js') }}"></script>
<script src="{{ asset('js/lib/inputmask/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('js/lib/inputmask/input-mask.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/datatable.js') }}"></script>
@stack('script')

<script>
    @if(Session::has('message'))
    var type = "{{Session::get('alert-type') }}"

    $(document).ready(function () {
        switch (type) {
            case 'success':
                toastr.success("{{ Session::get('message') }}", 'Sucesso', {
                    timeOut: 5000,
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "tapToDismiss": false
                })
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}", 'Erro', {
                    timeOut: 5000,
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "tapToDismiss": false
                })
            break;
        }
    });
    @endif
</script>

</body>

</html>