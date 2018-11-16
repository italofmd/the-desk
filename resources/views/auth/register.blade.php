<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">    
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <title>The Desk | Cadastro</title>    
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
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    
    <div id="main-wrapper">
        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content card">
                            <div class="login-form">
                                <img style="display: block; margin: 0 auto" src="{{ asset('images/login.png') }}" width="230">                             
                                <form style="margin-top: 40px;" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('name') ? 'has-error' : '' }}">
                                        <label for="name">Nome <span class="input-required">*</span></label>
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>   
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('name') }}</span>
                                        @endif                                                                             
                                    </div>
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('email') ? 'has-error' : '' }}">
                                        <label for="email">E-mail <span class="input-required">*</span></label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('password') ? 'has-error' : '' }}">
                                        <label for="password">Senha <span class="input-required">*</span></label>
                                        <input id="password" type="password" class="form-control" name="password" required>
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ Session::has('errors') && Session::get('errors')->has('password_confirmation') ? 'has-error' : '' }}">
                                        <label for="password-confirm">Confirmar senha <span class="input-required">*</span></label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>   
                                        @if(Session::get('errors'))
                                            <span class="form-control-feedback">{{  Session::get('errors')->first('password_confirmation') }}</span>
                                        @endif                                  
                                    </div>                               
                                    <button type="submit" class="btn btn-info btn-login btn-flat m-b-30 m-t-30">Cadastrar</button>
                                    <a class="btn btn-link text-center" href="{{ route('login') }}">Já possui uma conta?</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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