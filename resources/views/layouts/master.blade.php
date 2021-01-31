<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}?v={{ date('YmdHis') }}">

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-reboot.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-reboot.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/now-ui-dashboard.css?v=1.5.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/now-ui-dashboard.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/pe-icon-7-stroke.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/demo/demo.css') }}">
</head>
<title>
    @yield('title')
</title>

<body>
    <div id="app"></div>

    <div class="wrapper">
        <div class="sidebar" data-color="orange">
            <!--Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow" -->
            <div class="logo">
                <a href="#" class="simple-text logo-mini">
                    <i class="now-ui-icons business_bulb-63"></i>
                </a>
                <a href="#" class="simple-text logo-normal">
                    Jafari Group
                </a>
            </div>

            <div class="sidebar-wrapper" id="sidebar-wrapper">
                <ul class="nav">
                    <li class="{{ 'dashboard' == request()->path() ? 'active' : '' }}">
                        <a href='{{ url('dashboard') }}'>
                            <i class="now-ui-icons design_app"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="{{ 'new-member' == request()->path() ? 'active' : '' }}">
                        <a href='{{ url('new-member') }}'>
                            <i class="now-ui-icons users_single-02"></i>
                            <p>Member</p>
                        </a>
                    </li>

                    <li class="{{ 'role-loan' == request()->path() ? 'active' : '' }}">
                        <a href='{{ url('role-loan') }}'>
                            <i class="now-ui-icons business_briefcase-24"></i>
                            <p>Loan</p>
                        </a>
                    </li>

                    <li class="{{ 'role-installment' == request()->path() ? 'active' : '' }}">
                        <a href='{{ url('role-installment') }}'>
                            <i class="now-ui-icons business_money-coins"></i>
                            <p>Installments</p>
                        </a>
                    </li>

                    <li class="{{ '/view-dailybook' == request()->path() ? 'active' : '' }}">
                        <a href='{{ url('view-dailybook') }}'>
                            <i class="now-ui-icons files_paper"></i>
                            <p>Daily Book</p>
                        </a>
                    </li>

                    <li class="{{ '/view-expense' == request()->path() ? 'active' : '' }}">
                        <a href='{{ url('view-expense') }}'>
                            <i class="now-ui-icons shopping_bag-16"></i>
                            <p>Expenses</p>
                        </a>
                    </li>

                    <li class="{{ '/view-role' == request()->path() ? 'active' : '' }}">
                        <a href='{{ url('view-role') }}'>
                            <i class="now-ui-icons users_circle-08"></i>
                            <p>Role</p>
                        </a>
                    </li>

                    <li class="{{ '/role-view-help' == request()->path() ? 'active' : '' }}">
                        <a href='{{ url('role-view-help') }}'>
                            <i class="now-ui-icons ui-2_like"></i>
                            <p>Help</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel" id="main-panel">
            <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="#"> {{ Auth::user()->name }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a id="navbar" class="nav-link" href="{{ url('loan-paid') }}">
                                    <i class="now-ui-icons education_paper"></i>

                                </a>
                            </li>

                            <li class="nav-item">
                                <a id="navbar" class="nav-link" href="{{ url('loan-paidup') }}">
                                    <i class="now-ui-icons tech_laptop"></i>

                                </a>
                            </li>

                            <li class="nav-item">
                                <a id="navbar" class="nav-link" href="{{ url('loan-calc') }}">
                                    <i class="now-ui-icons business_bank"></i>

                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbar" class="nav-link" href="{{ route('logout') }}">
                                    <i class="now-ui-icons media-1_button-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
            </div>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    <footer class="footer">
    </footer>
    <!--   Core JS Files   -->
    <script src="{{ URL::asset('js/app.js') }}" defer></script>

    <script type="javascript" src="{{ URL::asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script type="javascript" src="{{ URL::asset('assets/js/jquery-3.5.1.slim.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/core/jquery.min.js') }}"> </script>
    <script src="{{ URL::asset('assets/js/dataTables.min.js') }}" defer></script>
    <script src="{{ URL::asset('assets/js/core/bootstrap.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/core/popper.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
    <script src="{{ URL::asset('assets/js/now-ui-dashboard.min.js?v=1.5.0') }}"></script>
    <script src="{{ URL::asset('assets/demo/demo.js') }}"></script>
    <script src="{{ URL::asset('assets/js/sweet-alert.js') }}"> </script>


    @if (session('status'))swal({ title: '{{ session('status') }}',
        icon: '{{ session('statuscode') }}',
        button: "Done!",});
    @endif

    @yield('scripts')
</body>

</html>
