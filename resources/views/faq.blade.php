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
                    <a href="{{ url('/booking') }}">Booking</a>
                    <a href="{{ url('/faq') }}">FAQ</a>

                    @if (Route::has('login'))
                    @auth  
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}</a>
                    @else
                    <a href="{{ route('register') }}">Register</a>
                    <a href="{{ route('login') }}">Login</a>
                    @endauth
                    @endif
                 </div>
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
</html>

<div class="footer">
  <p>Copyright 2018</p>
</div>