<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use Auth;
use View;
use App\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;

class StripeController extends Controller
{
    
    /**
     * Show the application paywith stripe.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithStripe()
    {
        return view('home');
    }
	
	public function show_order(Request $request)
    {
        $request->input('carId'); 
		$request->input('carMake'); 
		$request->input('carModel'); 
		$request->input('startTime'); 
		$request->input('endTime'); 
		
		return view('payment', compact('request'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithStripe(Request $request)
    {
	  /*	    try {
		Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

		$customer = Customer::create(array(
			'email' => $request->stripeEmail,
			'source' => $request->stripeToken
		));

		$charge = Charge::create(array(
			'customer' => $customer->id,
			'amount' => 1500,
			'currency' => 'usd'
		));
		
		$user = Auth::user();
        $bookings = $user->bookings()->get();
		return View::make('home')->with('bookings', $bookings);
	} catch (\Exception $ex) {
		return $ex->getMessage();
	}
	}*/
     $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            'amount' => 'required',
        ]);
        
        $input = $request->all();
        if ($validator->passes()) {           
            $input = array_except($input,array('_token'));            
            $stripe = Stripe::make('sk_test_dUTWdbIpaP25GuFbSSrRtKmZ');
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number'    => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year'  => $request->get('ccExpiryYear'),
                        'cvc'       => $request->get('cvvNumber'),
                    ],
                ]);
                if (!isset($token['id'])) {
                    \Session::put('error','The Stripe Token was not generated correctly');
                    return redirect()->route('/booknow');
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount'   => $request->get('amount'),
                    'description' => 'Add in wallet',
                ]);
                if($charge['status'] == 'succeeded') {
                    /**
                    * Write Here Your Database insert logic.
                    */
                    \Session::put('success','Money add successfully in wallet');
					$user = Auth::user();
                    $bookings = $user->bookings()->get();
					return View::make('home')->with('bookings', $bookings);
                } else {
                    \Session::put('error','Money not add in wallet!!');
                    return redirect()->route('/booknow');
                }
            } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('/booknow');
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('/booknow');
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('/booknow');
            }
        }
        \Session::put('error','All fields are required!!');
        return redirect()->route('/booknow');
    }    
	
}
