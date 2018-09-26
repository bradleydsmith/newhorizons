<br>
<br>

@extends('layouts.app')


@section('content')
<div class="theBox">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        <!-- For the lols -->
                        <img src="/images/carlogo.png" alt="carlogo" width="400" height="200">
                        <br>
                        <br>
                        <!------------------>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right ">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <a class="forgotpw" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>                 
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-7 offset-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('Login') }}
                                </button>

                    </form>                     
                     <button type="button" class="btn" onclick="window.location='{{ url("/register") }}'">New User? Create an account</button>                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
