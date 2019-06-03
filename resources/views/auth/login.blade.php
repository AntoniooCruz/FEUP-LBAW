@extends('layouts.app')

@section('content')

@yield('navbar')

    <div id="background"></div>
    <section class="loginBack">
    <section id="login">
        <div class="login container">
            <div class="row">
                <div id="main_container" class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-header">
                            <ul class="nav nav-pills card-header-pills">
                                <li id="personalBtn" class="nav-item col ">
                                    <a class="nav-link active" href="">Personal</a>
                                </li>
                                <li id="businessBtn" class="nav-item col">
                                    <a class="nav-link" href="">Business</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" class="form-signin">
                                    {{ csrf_field() }}
                                <div id="loginlogo"><img src="{{ asset('img/icon.png') }}" width="191,5" height="149,5"></div>
                                <div class="form-label-group">
                                    <input type="email" name="email" value="{{ old('email') }}" id="inputEmail" class="form-control" placeholder="Email address"
                                        required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="error">
                                            {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    <label for="inputEmail">Email address</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" name="password" id="inputPassword" class="form-control"
                                        placeholder="Password" required>
                                        @if ($errors->has('password'))
                                        <span class="error">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                    <label for="inputPassword">Password</label>
                                </div>

                                <div id = "remember-me" >
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember"  name="remember" {{ old('remember') ? 'checked' : '' }}> 
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                                </div>
                                <div id="resetPassword">
                                <a class="reset_pass" href="{{ url('/password/reset') }}">Lost your password?</a>
                            </div>
                                <span id="register-link">Don't have an account?<a id="registerbtn"
                                    href="{{ route('register') }}">Register</a></span>
                                <button id="loginbtn" class="btn btn-lg btn-primary btn-block"
                                    type="submit">Login</button>
                                <button id="googlebtn" class="btn btn-lg btn-outline-secondary btn-block" type="submit">
                                    Continue with <i class="fab fa-google"></i></button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

    @endsection