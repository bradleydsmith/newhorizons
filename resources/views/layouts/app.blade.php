<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{asset('/css/global.css')}}" rel="stylesheet" >
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>New Horizons</title>

   
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

<!--     <style>
    body {     
        background-image: url("images/car1.jpg");
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }




    </style> -->

    <!-- Styles -->
    
</head>
<div id="wrapper">
<body>

            <div class="content">
            <!-- Navigation Bar -->
                <div class="nav2">   
                    <div class="logo">
                        New Horizons
                    </div>        
                </div>

                <div class="thenav links">
                 
                    <a href="/">Home</a>
                    @if(Auth::check())
                    <a href="/home">Dashboard</a>                    
                    @endif
                    <!-- <a href="{{ url('/booking') }}">Booking</a> -->
                    @isAdmin
                        <div class="dropdown links">
                            <a class="dropbtn links" id="admin1">Admin</a>
                                <div class="dropdown-content links">
                                    <a href="/users" id="linkref">User Management</a>
                                    <a href="" id="linkref">Car Management</a> <!-- Insert Car management page link -->
                                    <a href="/addcar" id="linkref">Add cars</a>
                                </div>
                        </div>
					       @endisAdmin
                           <a href="{{ url('/faq') }}">FAQ</a>
                           @guest
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                           @else                             
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>
                                @endguest
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li> 
                    </ul>
                </div>
            </div>
     
        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</div>
</html>
