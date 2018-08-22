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

    <style>
    body {     
        background-image: url("images/car1.jpg");
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>

    <!-- Styles -->
    
</head>
<div id="wrapper">
<body>

            <div class="content">
                <div class="title m-b-md">
                    New Horizons
                </div>
            <!-- Navigation Bar -->
                <div class="links">
                    <a href="/">Home</a>
                    @isAdmin
						<a href="">User Management</a>
						<a href="">Car Management</a>
                         <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}</a>
					       @else
                                <a href="{{ url('/booking') }}">Booking</a>
                                <a href="{{ url('/faq') }}">FAQ</a>
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endisAdmin
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</div>
</html>
