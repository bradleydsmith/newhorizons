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
<body>

            <div class="content">
                <div class="title m-b-md">
                    New Horizons Car Sharing
                </div>
            <!-- Navigation Bar -->
                <div class="links">
                    <a href="/">Home</a>
                    @isAdmin
						<a href="">User Management</a>
						<a href="">Car Management</a>
					@else
                    <a href="{{ url('/booking') }}">Booking</a>
                    @endisAdmin
                    <a href="{{ url('/faq') }}">FAQ</a>
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
<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Car</div>
                <div class="card-body">
					<form method="post">
					{{ csrf_field() }}
						Make: <input type="text" name="make"> <br /><br />
						Model: <input type="text" name="model"> <br /><br />
						Year: <input type="text" name="year"> <br /><br />
						Seating capacity: <input type="text" name="seating"> <br /><br />
						Registration: <input type="text" name="rego"> <br /><br />
						<input type="submit">
					</form>
                </div>
            </div>
        </div>
    </div>
</div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>