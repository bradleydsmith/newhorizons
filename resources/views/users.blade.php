<br>
<br>

@extends('layouts.app')

@section('content')
<div id="wrapper">

<!-- Start writing here -->

<div class="welcometext">
@if(Auth::check())
<br>
Insert Users search function here
<br>
No Controller added yet
</div>
@endif
        @if(Auth::guest())
            <a href="/login" class="btn btn-info"> You need to login as admin to continue</a>
            <br>
        @endif

</div>

@endsection

