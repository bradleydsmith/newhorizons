<br><br>

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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Confirm your order! </div>
					<div class="card-body">
						<div class="row">
						  <div class="col-md-6 col-md-offset-3">
							<!--<form action="/home" method="POST">-->
							{{ csrf_field() }}
							    {!! Form::open(['url' => route('order-post'), 'data-parsley-validate', 'id' => 'payment-form']) !!}
								<!--
								Stripe gives us the list of credit card numbers for testing, 
								the most popular is: 
								4242 4242 4242 4242 
								and then you enter any future date, 
								and any CVC code – and then you should return to home with trip booking:
								
								<script
									src="https://checkout.stripe.com/checkout.js" 
									data-key="pk_test_5CxGzO3ckqHJ6YdHF5Kry3eT"
									data-amount="1500"
									data-name="New Horizons"
									data-description="Pay for your vehicle"
									data-image="http://csl.uk.net/wp-content/uploads/2016/01/favicon.png"
									data-locale="auto"
									data-currency="usd">
								</script>-->
								<div class="form-group" id="email-group">
									{!! Form::label('email', 'Email address:') !!}
									{!! Form::email('email', null, [
										'class' 						=> 'form-control',
										'placeholder'                   => 'email@example.com',
										'required'                      => 'required',
										'data-parsley-required-message' => 'Email name is required',
										'data-parsley-trigger'          => 'change focusout',
										'data-parsley-class-handler'    => '#email-group'
										]) !!}
								</div>
								
								<div class="form-group"  id="cc-group">
									{!! Form::label(null, 'Credit card number:') !!}
									{!! Form::text(null, null,  [
										'class'                         => 'form-control',
										'required'                      => 'required',
										'data-stripe'                   => 'number',
										'data-parsley-type'             => 'number',
										'maxlength'                     => '16',
										'data-parsley-trigger'          => 'change focusout',
										'data-parsley-class-handler'    => '#cc-group'
										]) !!}
								</div>
								<br>
								<div class="form-group" id="ccv-group">
									{!! Form::label(null, 'Card Validation Code (3 or 4 digit number):') !!}
									{!! Form::text(null, null, [
									   'class'                         => 'form-control',
									   'required'                      => 'required',
									   'data-stripe'                   => 'cvc',
						 	 		   'data-parsley-type'             => 'number',
									   'data-parsley-trigger'          => 'change focusout',
						 			   'maxlength'                     => '4',
									   'data-parsley-class-handler'    => '#ccv-group'
									   ]) !!}
								</div>
								<br>
								<div class="form-group" id="exp-m-group">
									{!! Form::label(null, 'Ex. Month') !!}
									{!! Form::selectMonth(null, null, [
										'class'                 => 'form-control',
										'required'              => 'required',
										'data-stripe'           => 'exp-month'
									     ], '%m') !!}
								</div>
								<br>
								<div class="form-group" id="exp-y-group">
								    {!! Form::label(null, 'Ex. Year') !!}
								    {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [
									   'class'             => 'form-control',
									   'required'          => 'required',
									   'data-stripe'       => 'exp-year'
									   ]) !!}
								</div>
							   
								<div class="form-group">
									{!! Form::submit('Confirm!', ['class' => 'btn btn-primary btn-order', 'id' => 'submitBtn', 'style' => 'margin-bottom: 10px;']) !!}
								</div>
								
								<div class="row">
									<div class="col-md-12">
										<span class="payment-errors" style="color: red;margin-top:10px;"></span>
									</div>
								</div>

							{!! Form::close() !!}
								<!--</form>-->
								
						  </div>

						</div>
				</div>
			</div>
		</div>
	</div>
</div>


<br><br><br>
<!-- PARSLEY -->
    <script>
        window.ParsleyConfig = {
            errorsWrapper: '<div></div>',
            errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
            errorClass: 'has-error',
            successClass: 'has-success'
        };
    </script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
	
<!-- PARSLEY CSS config -->
    <style>
        .alert.parsley {
            margin-top: 5px;
            margin-bottom: 0px;
            padding: 10px 15px 10px 15px;
        }

        .check .alert {
            margin-top: 20px;
        }
    </style>
	
<!-- Inlude Stripe.js -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        // This identifies your website in the createToken call below
        Stripe.setPublishableKey('{!! env('STRIPE_PK') !!}');

        jQuery(function($) {
            $('#payment-form').submit(function(event) {
                var $form = $(this);

                // Before passing data to Stripe, trigger Parsley Client side validation
                $form.parsley().subscribe('parsley:form:validate', function(formInstance) {
                    formInstance.submitEvent.preventDefault();
                    return false;
                });

                // Disable the submit button to prevent repeated clicks
                $form.find('#submitBtn').prop('disabled', true);

                Stripe.card.createToken($form, stripeResponseHandler);

                // Prevent the form from submitting with the default action
                return false;
            });
        });

        function stripeResponseHandler(status, response) {
            var $form = $('#payment-form');

            if (response.error) {
                // Show the errors on the form
                $form.find('.payment-errors').text(response.error.message);
                $form.find('.payment-errors').addClass('alert alert-danger');
                $form.find('#submitBtn').prop('disabled', false);
                $('#submitBtn').button('reset');
            } else {
                // response contains id and card, which contains additional card details
                var token = response.id;
                // Insert the token into the form so it gets submitted to the server
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                // and submit
                $form.get(0).submit();
            }
        };
    </script>
@endsection


