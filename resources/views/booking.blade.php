<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('/css/global.css')}}" rel="stylesheet" >
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>New Horizons - Booking</title>

    </head>
    <body>
        <br>
            <br>
             <div class="content">
                <div class="title m-b-md">
                    New Horizons Car Sharing
                </div>

            <!-- Navigation Bar -->
                <div class="links">
                    <a href="/">Home</a>
                    @isAdmin
						<a href="/users">User Management</a>
						<a href="/addcar">Car Management</a>
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
<br>
<br>


<div class="welcometext">
 @if(Auth::check())

    
<div>
NOW YOU SEE ME
<br>
INSERT BOOKING STUFF

</div>

@endif

            </div>
            @if(Auth::guest())
              <a href="/login" class="logbtn btn btn-info"> You need to login to make a booking</a>
              <br>
              <br>
              <a href="/register" class="regbtn btn btn-info"> Click here to register an account</a>
            @endif
            </div>

</div>

<div>
    
</div>

    </body>

<div class="footer">
  <p>Copyright 2018</p>
</div>
</html>

