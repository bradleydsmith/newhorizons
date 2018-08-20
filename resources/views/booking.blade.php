<br>
<br>

@extends('layouts.app')

@section('content')
<div id="wrapper">


<div class="welcometext">
 @if(Auth::check())

<!-- Book now -->
<div class = "booknow" >
    <a href="/booknow" class="booknow"> Click here to book now</a>
</div>

<!-- Book Later -->    
<div>
    <a href="/booklater" class="booklater"> Click here to book later</a>
</div>
Add box and image
@endif
            </div>

            @if(Auth::guest())
              <a href="/login" class="logbtn btn btn-info"> You need to login to make a booking</a>
              <br>
              <br>
              <a href="/register" class="regbtn btn btn-info"> Click here to register an account</a>
            @endif
            </div>
</div> <!-- wrapper div -->

@endsection

