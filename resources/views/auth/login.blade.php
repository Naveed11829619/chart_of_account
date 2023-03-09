@extends('layouts.loginLayout')
<style>
  
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;1,300&display=swap');

    .login-container {
    justify-content: center;
    align-items: center;
    display: flex;
}
.inputCss {
    box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px !important; 
    outline: none;
    border-radius: 5px !important;
    height: 45px !important;
    border:0px !important;
}
.forgot_password{
    color: #000 !important;
}
.bg-red{
    background-color: #ee3734 !important;
}
</style>
@section('content')
    <div class="mainLoginPage  row m-0">
        <div class="login-container p-0 position-relative">
            <div class="login-container-conten">
                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                   <div class="text-center">
                    <img src="{{asset('assets/img/logo.svg')}}" class="mb-3" width="100" alt="" srcset="">
                    <h1 class="mb-5 pt-3 "><b>LOG &nbsp;IN</b></h1>
                   </div>
                    <p class="field">
                        {{-- <label for="email" class="col-form-label">{{ __('Email Address') }}</label> --}}
                        <input id="email" placeholder="Login" type="email" class="form-control inputCss @error('email') is-invalid @enderror "
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </p>
                    <p class="field pt-2">
                        {{-- <label for="password" class="col-form-label">{{ __('Password') }}</label> --}}
                        <input placeholder="Password" id="password" type="password"
                            class="form-control inputCss @error('password')  is-invalid @enderror " name="password" required
                            autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </p>

                    <div class="form-group row justify-content-center">
                        <div class="col-12 p-0 ml-5 text-right">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link forgot_password" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="col-md-8 pt-2 text-center">
                            <button type="submit" class="btn btn-danger bg-red px-5 py-2 font-weight-bolder">
                                {{ __('Login') }}
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
