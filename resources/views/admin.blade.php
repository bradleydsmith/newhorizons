<br>
<br>

@extends('layouts.app')

@section('content')
<div id="wrapper">


<div class="welcometext">
@if(Auth::check())  <!-- Change to isAdmin -->

<!-- Start writing here -->
This is an admin page.
<br>
Insert User logins/Data/Stats etc.

<!------------------------>
@endif

</div>
        @if(Auth::guest())
            <a href="/login" class="btn btn-info"> You need to login as admin to continue</a>
            <br>
        @endif
</div>
<br>
</div>


</div> <!-- div wrapper -->

@endsection
