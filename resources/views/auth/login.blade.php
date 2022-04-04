@extends('layouts.auth')

@section('main-content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            @if ($errors->any())
            <div class="alert alert-danger border-left-danger" role="alert">
                <ul class="pl-4 my-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <span class="login100-form-title p-b-34">
                    {{ __('Login') }}
                </span>
                
                <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Email">
                    <input id="first-name" class="input100" type="text" name="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required autofocus>
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
                    <input class="input100" type="password" name="password" placeholder="{{ __('Password') }}" required>
                    <span class="focus-input100"></span>
                </div>
                
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Login
                    </button>
                </div>
            </form>

            <div class="login100-more" style="background-image: url('../img/bg.png');"></div>
        </div>
    </div>
</div>
<div id="dropDownSelect1"></div>
@endsection
