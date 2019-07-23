<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .hover-dark{
            color: #ddd;
            cursor: pointer;
        }
        .hover-dark:hover{
            color:white;
        }
        .bar{
            background-color: #343a40;
            margin-bottom: 50px;
        }
        .page-heading{
            color: #343a40;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
        }
        .nav-link{
            color: white;
            font-family: "Courier New";
            font-size: 22px;
        }
        .nav-link:hover{
            color: darkorange;
        }
        .stylized-input{
            border: none;
            border-bottom: 1px solid #343a40;
        }
        .margin-bottom-30{
            margin-bottom: 30px;
        }
        .is-complete{
            text-decoration: line-through;
        }
    </style>

    <title>@yield('title','Laravel Project')</title>


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:24px 0;">
    <a class="navbar-brand" href="javascript:void(0)"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navb">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="/todo">Todo</a></li>
            <li class="nav-item"><a class="nav-link" href="/projects">Projects</a></li>
            <li class="nav-item"><a class="nav-link" href="/albums">Albums</a></li>

        </ul>

        @auth
            <span style="color: #bbbbbb" class="nav-link">{{auth()->user()->name}}</span>

                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

        @endauth

        @guest
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

            @if (Route::has('register'))

                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

            @endif
        @endguest

    </div>
</nav>

    <div class="bar">

    </div>
    @yield('content')
</body>
</html>