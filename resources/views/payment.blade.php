<br><br>
<link href="{!! asset('css/stripe.css') !!}" media="all" rel="stylesheet" type="text/css" />
<script src="https://js.stripe.com/v3/"></script>
@extends('layouts.app')

@section('content')

<br><br>
<div id="wrapper">
	<div class="bookingbox">
		<table class="table table-striped">
			<thead><h2> Order details: </h2>
				<tr>
					<th>Car ID</th>
					<th>Model</th>
					<th>Make</th>
					<th>Start Time</th>
					<th>Finish Time</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<th>{{ $request->carId }}</th>
				<th>{{ $request->carMake }}</th>
				<th>{{ $request->carModel }}</th>
				<th>{{ $request->startTime }}</th>
				<th>{{ $request->endTime }}</th>
			</tr>
			</tbody>
		</table>
	</div>
</div>
<br>

<!--<form action="/home" method="POST">
*** HOW TO USE STRIPE ***
	Stripe gives us the list of credit card numbers for testing, 
	the most popular is: 
	4242 4242 4242 4242 
	and then you enter any future date, 
	and any CVC code – and then you should return to home with trip booking:
	
*** POP-UP CODE ***	
	<script
		src="https://checkout.stripe.com/checkout.js" 
		data-key="pk_test_5CxGzO3ckqHJ6YdHF5Kry3eT"
		data-amount="1500"
		data-name="New Horizons"
		data-description="Pay for your vehicle"
		data-image="http://csl.uk.net/wp-content/uploads/2016/01/favicon.png"
		data-locale="auto"
		data-currency="usd">
	</script> -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Paywith Stripe</div>
                <div class="card-body">
				
                    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="/home" >
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('card_no') ? ' has-error' : '' }}">
                            <label for="card_no" class="col-md-4 control-label">Card No</label>
                            <div class="col-md-6">
                                <input id="card_no" type="text" class="form-control" name="card_no" value="{{ old('card_no') }}" autofocus>
                                @if ($errors->has('card_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('card_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ccExpiryMonth') ? ' has-error' : '' }}">
                            <label for="ccExpiryMonth" class="col-md-4 control-label">Expiry Month</label>
                            <div class="col-md-6">
                                <input id="ccExpiryMonth" type="text" class="form-control" name="ccExpiryMonth" value="{{ old('ccExpiryMonth') }}" autofocus>
                                @if ($errors->has('ccExpiryMonth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ccExpiryMonth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ccExpiryYear') ? ' has-error' : '' }}">
                            <label for="ccExpiryYear" class="col-md-4 control-label">Expiry Year</label>
                            <div class="col-md-6">
                                <input id="ccExpiryYear" type="text" class="form-control" name="ccExpiryYear" value="{{ old('ccExpiryYear') }}" autofocus>
                                @if ($errors->has('ccExpiryYear'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ccExpiryYear') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('cvvNumber') ? ' has-error' : '' }}">
                            <label for="cvvNumber" class="col-md-4 control-label">CVV No.</label>
                            <div class="col-md-6">
                                <input id="cvvNumber" type="text" class="form-control" name="cvvNumber" value="{{ old('cvvNumber') }}" autofocus>
                                @if ($errors->has('cvvNumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cvvNumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Amount</label>
                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" autofocus>
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Paywith Stripe
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  function stripeResponseHandler(status, response) {
	if (response.error) {
	  $('.error')
		.removeClass('hide')
		.find('.alert')
		.text(response.error.message);
	} else {
	  // token contains id, last4, and card type
	  var token = response['id'];
	  // insert the token into the form so it gets submitted to the server
	  $form.find('input[type=text]').empty();
	  $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
	  $form.get(0).submit();
	}
  }
}
</script>

<br><br><br>

@endsection


