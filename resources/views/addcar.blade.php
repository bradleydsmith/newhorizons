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

    <title>New Horizons - Add Car</title>

   

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">


    <!-- Styles -->
    
</head>
<div id="wrapper">  
<body>
    <br>
        <br>
            <div class="content">
                <div class="title m-b-md">
                    New Horizons
                </div>
            <!-- Navigation Bar -->
                <div class="links">
                    <a href="/admin">Admin Home</a>
					<a href="/users">User Management</a>
					<a href="/addcar">Car Management</a>
                        <!-- Authentication Links -->
                        @guest
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        @else

                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
<br>
<br>

@if(Auth::check())  <!-- Change to isAdmin -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Car</div>
                <div class="card-body">
					<form method="post">
					{{ csrf_field() }}
						<label>Make:</label><input type="text" name="make"> <br /><br />
						<label>Model:</label> <input type="text" name="model"> <br /><br />
						<label>Year:</label> <input type="text" name="year"> <br /><br />
						<label>Seating capacity:</label> <input type="text" name="seating"> <br /><br />
						<label>Registration:</label> <input type="text" name="rego"> <br /><br />
						<label>Latitude:</label> <input type="text" name="lat"><br><br>
						<label>Longitude:</label> <input type="text" name="lng"><br><br>
						<input type="submit" class="submitbtn">
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
        @if(Auth::guest())
            <a href="/login" class="btn btn-info"> You need to login as admin to continue</a>
            <br>
        @endif


        <main class="py-4">
            @yield('content')
        </main>
    </div>

</div>
</body>
</div> <!-- wrapper div -->
</html>
