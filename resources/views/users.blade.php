<br>
<br>

@extends('layouts.app')

@section('content')
<div id="wrapper">

<!-- Start writing here -->

<div class="bookingbox">
	
@if(Auth::check()) 

<form action="/search" method="POST" role="search">
	{{csrf_field()}}
		<input type="text" class="form-control" name="q" placeholder="Search users">
		<br>
		<br>
			<button type="submit" class="btn btn-primary">Search
	</button>
</form>

	<h3> Search Results </h3>
	<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Username</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Status</th>
			</tr>
		</thead>
		@if(isset($details))
		<tbody>
			@foreach($details as $user)
			<tr>
				<td> {{ $user->name }} </td>
				<td> {{ $user->fname }} </td>
				<td> {{ $user->lname }} </td>
				<td> {{ $user->email }} </td>
				<form method="post" action="/user/status">
					{{ csrf_field() }}
					<input type="hidden" name="userId" value="{{ $user->id }}">
					@if($user->type == "suspended")
						<input type="hidden" name="status" value="unsuspend">
						<td><button class="btn btn-primary">Unsuspend</button></td>
					@else
						<input type="hidden" name="status" value="suspend">
						<td><button class="btn btn-primary">Suspend</button></td>
					@endif
				</form>
			</tr>
			@endforeach
		</tbody>
	</table>
	</div>
	@elseif(isset($message))
	<p> {{ $message }} </p>
@endif

@endif

        @if(Auth::guest())
            <a href="/login" class="btn btn-info"> You need to login as admin to continue</a>
            <br>
        @endif

</div>
</div>
@endsection

