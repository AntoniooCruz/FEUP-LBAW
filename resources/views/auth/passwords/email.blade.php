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
                                    <span class="nav-link active" href="">Recover your password</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}" class="form-signin">
                                {{ csrf_field() }}
                                <div id="loginlogo"><img src="{{ asset('img/icon.png') }}" width="191,5" height="149,5">
                                </div>
                                <div id="resetDescription" class="form-group{{ $errors->has('email') ? ' has-error' : '' }} ml-3 ">Please insert your email address: </div>
                                <div id="emailInputReset" class="form-label-group">
                                    <input type="email" name="email" value="{{ old('email') }}" id="inputEmail"
                                        class="form-control" placeholder="Email address" required autofocus>
                                    @if ($errors->has('email'))
                                    <span class="error">
                                        {{ $errors->first('email') }}
                                    </span>
                                    @endif
                                    <label for="inputEmail">Email address</label>
                                </div>
                                <div class="form-group">
                                    <div id="resetEmail" class="">
                                        <button type="submit" class="btn btn-primary">
                                            Send Password Reset Link
                                        </button>
                                        <div >Go back to <a href="{{ url('/login') }}">login</a></div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

@endsection