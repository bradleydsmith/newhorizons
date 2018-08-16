<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link href="{{asset('/css/global.css')}}" rel="stylesheet" >
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>New Horizons - FAQ page</title>

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
                    <a href="/">Home</a>
                    @isAdmin
						<a href="/users">User Management</a>
						<a href="/addcar">Car Management</a>
					@else
                    <a href="{{ url('/booking') }}">Booking</a>
                    <a href="{{ url('/faq') }}">FAQ</a>
                    @endisAdmin
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

FAQ QUESTIONS
1
2
3
4
5
6
7
8


</div>



    </body>
</div>    
</html>

<div class="footer">
  <p>Copyright 2018</p>
</div>