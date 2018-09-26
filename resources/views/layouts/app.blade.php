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
    
    .custnav {
		background-color: rgba(225, 225, 225, 0.7);
		font-family: Raleway,sans-serif;
		font-weight: 600;
	}
	.navlink {
		font-color: black;
	}
    </style>
</head>

<div id="wrapper">
<body>
	<nav class="navbar fixed-top navbar-light custnav navbar-expand-lg">
		<span class="navbar-brand">New Horizons</span>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="/">Home</a>
				</li>
				@if(Auth::check())
				<li class="nav-item">
					<a class="nav-link" href="/home">Dashboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/booklater">Book Later</a>
				</li>
				@endif
				@isAdmin
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="adminDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Admin
					</a>
					<div class="dropdown-menu" aria-labelledby="adminDropdownMenuLink">
						<a class="dropdown-item" href="/users">User Management</a>
						<a class="dropdown-item" href="/carsmanage">Car Management</a>
						<a class="dropdown-item" href="/addcar">Add Car</a>
					</div>
				</li>
				@endisAdmin
				@guest
				<li class="nav-item">
					<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
				</li>
				@else
				<li class="nav-item">
					<a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}">{{ __('Logout') }}</a>
				</li>
				@endguest
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
                </form>
			</ul>
		</div>
	</nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</div>
</html>
