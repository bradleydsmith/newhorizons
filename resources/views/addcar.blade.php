<br>
<br>

@extends('layouts.app')

@section('content')
</head>
<div id="wrapper">  

@if(Auth::check())  <!-- Change to isAdmin -->

<div class="thebox">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Add Car</div>
                <div class="card-body">
                    <div class="form-group row">
					<form method="post">
					{{ csrf_field() }}
						<label class="col-sm-5 col-form-label text-md-right">Make</label><input type="text" class="col-md-7 form-control" name="make"> <br /><br />
						<label class="col-sm-5 col-form-label text-md-right">Model</label> <input type="text" class="col-md-7 form-control" name="model"> <br /><br />
						<label class="col-sm-5 col-form-label text-md-right">Year</label> <input type="text" class="col-md-7 form-control" name="year"> <br /><br />
						<label class="col-sm-5 col-form-label text-md-right">Seating No.</label> <input type="text" class="col-md-7 form-control" name="seating"> <br /><br />
						<label class="col-sm-5 col-form-label text-md-right">Registration</label> <input type="text" class="col-md-7 form-control" name="rego"> <br /><br />
						<label class="col-sm-5 col-form-label text-md-right">Latitude</label> <input type="text" class="col-md-7 form-control" name="lat"><br><br>
						<label class="col-sm-5 col-form-label text-md-right">Longitude</label> <input type="text" class="col-md-7 form-control" name="lng"><br><br>
						<input type="submit" class="btn btn-primary col-md-3 offset-md-6">
					</form>
                </div>
            </div>
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
</div> <!-- wrapper div -->
@endsection