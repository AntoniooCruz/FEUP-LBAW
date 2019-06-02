@extends('layouts.app')

@section('custom-scripts')
<script type="text/javascript" src={{ asset('js/register.js') }} defer></script>
@endsection

@section('content')

 <div id="background"></div>
 <section class="loginBack">
    <section id="register-personal">
        <div class="login container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
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
                          <!-- FORM -->
                            <form class="form-register" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                <div id="loginlogo"><img src="{{ asset('img/icon.png') }}" ></div>

                                <div class="form-label-group">
                                    <!-- NAME -->
                                    <input type="text" id="inputName" class="form-control" placeholder="Name" 
                                    name="name" value="{{ old('name') }}" required autofocus>
                                    <label for="inputName">Name</label>
                                    <label for="name">Name</label>
                                    @if ($errors->has('name'))
                                      <span class="error">
                                          {{ $errors->first('name') }}
                                      </span>
                                    @endif
                                </div>

                                <div class="form-label-group">
                                  <!-- USERNAME -->
                                    <input type="text" id="inputUserName" class="form-control" placeholder="Username" 
                                    name="username" value="{{ old('username') }}" required autofocus>
                                    <label for="inputUserName">Username</label>
                                </div>

                              <!-- EMAIL -->
                                <div class="form-label-group">
                                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address"
                                    name="email" value="{{ old('email') }}" required autofocus>
                                    <label for="inputEmail">Email address</label>
                                    @if ($errors->has('email'))
                                    <span class="error">
                                        {{ $errors->first('email') }}
                                    </span>
                                    @endif
                                </div>

                                <!-- PASSWORD -->
                                <div class="form-label-group">
                                    <input type="password" id="inputPassword" class="form-control"
                                        placeholder="Password" name="password" value="{{ old('password') }}" onkeyup='checkPasswordMatch();' required>
                                    <label for="inputPassword">Password</label>
                                    <div class="help-tooltip">
                                    <i id="onlineHelp" class="far fa-question-circle"></i>
                                    <span id="tooltipMessage" class="tooltiptext"> 
                                        Password must contain:
                                        <hr>
                                        <p id="letter" >A <b>lowercase</b> letter</p>
                                        <p id="capital">A <b>capital</b> letter</p>
                                        <p id="number">A <b>number</b></p>
                                        <p id="length">Minimum <b>6 characters</b></p></span>
                                    </div>
                                    @if ($errors->has('password'))
                                      <span class="error">
                                          {{ $errors->first('password') }}
                                      </span>
                                    @endif
                                </div>

                                <div class="form-label-group">
                                        <input id="password-confirm" class="form-control" type="password" name="password_confirmation" 
                                        onkeyup='checkPasswordMatch();' placeholder="Confirm Password" required>
                                        <span id='password-match'></span>
                                        <label for="password-confirm">Confirm Password</label>
                                </div>

                                <span id="register-link">Already have an account?<a id="registerbtn"
                                        href="{{ route('login') }}">Log in</a></span>
                                <button id="loginbtn" class="btn btn-lg btn-primary btn-block"
                                    type="submit">Register</button>
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
