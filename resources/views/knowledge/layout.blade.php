<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Desk | @yield('title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('knowledge/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/toastr/toastr.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('knowledge/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('knowledge/css/main.css') }}">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('knowledge/css/datatable.css') }}">
    @stack('style')
</head>

<body>
    <header id="hero" class="hero overlay">
        <nav class="navbar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-bars"></span>
                    </button>
                    <a href="{{ route('knowledge') }}" class="brand">
                        <img src="{{ asset('knowledge/images/logo.png') }}" alt="The Desk" width="100px">
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ route('knowledge') }}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Artigos
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('knowledgeSearch') }}">
                                Pesquisar
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}">
                                Dashboard
                            </a>
                        </li>
                        @if(Auth::user()->type_id == 1)
                            <li>
                                <a href="{{ route('articleIndex') }}" class="btn btn-success nav-btn">Gerenciar</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('header')
    </header>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-3">
                    <a href="{{ route('knowledge') }}" class="brand">
                        <img src="{{ asset('knowledge/images/logo-grey.png') }}" alt="The Desk" width="100px">
                        <span class="circle"></span>
                    </a>
                </div>
                <div class="col-lg-7 col-md-5 col-sm-9">
                    <ul class="footer-links">
                        <li><a href="{{ route('knowledge') }}">Home</a></li>
                        <li><a href="#">Artigos</a></li>
                        <li><a href="{{ route('knowledgeSearch') }}">Pesquisar</a></li>
                        <li><a href="{{ route('home') }}">Dashboard</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="copyright">
                        <p>© 2018 Todos os direitos reservados</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('knowledge/js/jquery-1.12.3.min.js') }}"></script>
    <script src="{{ asset('knowledge/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('knowledge/js/main.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="{{ asset('knowledge/js/summernote-pt-BR.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/datatables-init.js') }}"></script>
    <script src="{{ asset('js/lib/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/lib/toastr/toastr.init.js') }}"></script>
    <script src="{{ asset('js/lib/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('knowledge/js/app.js') }}"></script>
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