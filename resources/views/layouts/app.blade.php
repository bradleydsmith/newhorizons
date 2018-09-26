<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true"> -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">



    <link href="{{asset('/css/global.css')}}" rel="stylesheet" >
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>New Horizons</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <!-- Styles: Background -->
    <style>
    body {
        background-image: url("images/car1.jpg");
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }
    </style>
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

                <div class="thenav  links">

                    <a href="/">Home</a>
                    @if(Auth::check())
                    <a href="/home">Dashboard</a>
                    <a href="/booklater">Book Later</a>
                    @endif
                    <!-- <a href="{{ url('/booking') }}">Booking</a> -->
                    @isAdmin
                        <div class="dropdown links">
                            <a class="dropbtn links" id="admin1">Admin</a>
                                <div class="dropdown-content links">
                                    <a href="/users" id="linkref">User Management</a>
                                    <a href="/carsmanage" id="linkref">Car Management</a> <!-- Insert Car management page link -->
                                    <a href="/addcar" id="linkref">Add cars</a>
                                </div>
                        </div>
					       @endisAdmin
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
