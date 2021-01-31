<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome Member</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.ico') }}?v={{ date('YmdHis') }}">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <div class="navbar-brand js-scroll-trigger">
                <a href="{{ url('/login') }}">Welcome</a>
            </div>
            <button
                class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                <a href="{{ url('/login/member') }}">Login</a>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">

                    @if (Route::has('login'))
                        @auth
                            <li><a href="{{ url('/home') }}">Home</a></li>
                        @else
                            <li>
                                <a href="{{ url('/login/member') }}">
                                    <i class="fa fa-user"> </i>Login</a>
                            </li>
                        @endif
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <header class="masthead bg-orange text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <img class="masthead-avatar mb-5 profile-pic" src="assets/img/logo.svg" alt="" />
                <button
                    class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                    type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <a href="{{ url('/login/member') }}"> LOGIN </a>
                </button>
            </div>

        </header>
        </div>
    </body>
    <script src="js/scripts.js"></script>

    </html>
