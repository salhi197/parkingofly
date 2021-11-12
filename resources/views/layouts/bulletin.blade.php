
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('mart/assets/images/favicon.png')}}">
    <title>Gestion Labo</title>
    <!-- Custom CSS -->
    
    <!-- Custom CSS -->
    <link href="{{asset('mart/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet" />
    <link href="{{asset('css/dataTables.bootstrap4.css')}}" rel="stylesheet" />
    


    <style>
        .fc-agendaWeek-view tr {
            height:80px;
        }

        .fc-agendaDay-view tr {
            height: 60px;
        }
        b{
            display: hidden;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">


        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand" style="background:#154762;color:white">
                        <!-- Logo icon -->
                        <a href="index.html">
                            <span class="logo-text">
                                <img src="{{asset('img/logo.jpeg')}}" width="150px" alt="homepage" class="dark-logo">
                                <img src="{{asset('img/logo.jpeg')}}" width="150px" class="light-logo" alt="homepage">
                            </span>
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>

            </nav>
        </header>





        <div class="page-wrapper">
            @yield('page_wrapper')
            <div class="container-fluid">
                <div class="row"> 
                    <div class="col-md-12">
                    @yield('content')
                    </div>
                </div>
            </div>
            @yield('modals')
    
        </div>
    </div>
    <script src="{{asset('mart/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('mart/assets/extra-libs/taskboard/js/jquery.ui.touch-punch-improved.js')}}"></script>    
    <script src="{{asset('mart/assets/extra-libs/taskboard/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('mart/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('mart/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('mart/dist/js/app-style-switcher.js')}}"></script>    
    <script src="{{asset('mart/dist/js/feather.min.js')}}"></script>
    <script src="{{asset('mart/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('mart/dist/js/sidebarmenu.js')}}"></script>
    <script src="{{asset('mart/dist/js/custom.min.js')}}"></script>    
    <script src="{{asset('mart/assets/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}" crossorigin="anonymous" ></script>
    <script src="{{asset('js/datatables-demo.js')}}"></script>
    <script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="{{asset('js/datatable-basic.init.js')}}"></script>
    <script src="{{asset('js/dynamic-form.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>

    <script>
        @if(session('success'))
            $(function(){
                toastr.success('{{Session::get("success")}}')
            })
        @endif
        @if ($errors->any())
            $(function(){
                @foreach ($errors->all() as $error)
                        toastr.error('{{$error}}')
                @endforeach
            })
        @endif
        @if(session('error'))
            $(function(){
                toastr.error('{{Session::get("error")}}')
            })
        @endif
</script>
    @yield('scripts')
</body>

</html>