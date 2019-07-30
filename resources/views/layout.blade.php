<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

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
                <li class="nav-item @yield('active_react')"><a class="nav-link" href="/react">React</a></li>
                <li class="nav-item"><a class="nav-link" href="/projects">Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="/albums">Albums</a></li>

            </ul>

            @auth
                <span style="color: #bbbbbb" class="nav-link">{{auth()->user()->name}}</span>

                <ul class="nav nav-tabs">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" >

                            <div style="max-height: 200px; overflow: scroll">
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                @if($notification->type == 'App\Notifications\AlbumCreated')

                                <a class="dropdown-item" href="#" onclick="markRead({{$notification->data['id']}})">
                                    <span style="color: cornflowerblue; " id="dot-{{$notification->data['id']}}"> <i class="fa fa-dot-circle-o"></i> </span> You created an album: {{$notification->data['title']}}
                                </a>

                                @endif
                            @endforeach

                                @if(count(auth()->user()->unreadNotifications)==0)
                                    <a class="dropdown-item" href="#">No Notifications!</a>
                                @endif
                            </div>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>




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

        <script>
            function markRead(id) {

                document.getElementById("dot-"+id).style.display = "none";

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText==true){
                            //document.getElementById("dot-"+id).innerHTML = "";
                        }
                    }
                };
                xmlhttp.open("GET", "markRead/" + id, true);
                xmlhttp.send();

            }
        </script>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>