<br>
<br>

@extends('layouts.app')

@section('content')
<div id="wrapper">


<div class="bookingtext">
 @if(Auth::check())



<!-- Book now -->      
<div class = "bookingbox" >
    <img src="/images/booknowcar.png" alt="booknowcar" width="100" height="100">
    If you are ready to leave now 
    <a href="/booknow" class="bookbtn btn btn-info"> Book now</a>
</div>
</div>

<!-- Book Later -->
<div class="bookingbox">    
<div>
    <img src="/images/booklatericon.png" alt="booklatericon" width="100" height="100">
   Reserve a car for a later date.
    <a href="/booklater" class="bookbtn btn btn-info"> Book Later</a>
</div>
</div>




@endif
            </div>

            @if(Auth::guest())

            <div class="bookingbox">
              <img src="/images/login.png" alt="booklatericon" width="100" height="100">
              <a href="/login" class="hometext btn btn-primary"> You need to login to make a booking</a>
            </div>
              <br>
              <br>
            <div class="bookingbox">
              <img src="/images/register.png" alt="booklatericon" width="100" height="100">
              <a href="/register" class="hometext btn btn-primary"> Click here to register an account</a>
            </div>
            @endif
            </div>
</div> <!-- wrapper div -->

@endsection

