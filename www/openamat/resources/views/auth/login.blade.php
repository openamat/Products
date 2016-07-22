@extends('layouts.master')

@section('stylesheets')

    <style>
        body {
            background: #313034;
            color: #fff;
            font-size: 14px;
            font-family: 'Lato', sans-serif;
        }
        .navbar, .footer {
            display: none;
        }
    </style>

@stop

@section('app-content')

    <div class="dark-container">
        <div class="logo-small">
            <img src="img/logo.png" />
        </div>
        <form method="POST" action="/login" class="login-form">
            {!! csrf_field() !!}
            <div class="input-container">
                <label>Indirizzo email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Inserisci email">
            </div>
            <div class="input-container">
                <label class="grey">Password <a href="/password/email">(DIMENTICATA?)</a></label>
                <div class="input-right-icon">
                    <input type="password" name="password" id="password" placeholder="Inserisci password">
                    <button class="right-icon" onclick="javascript: if(document.getElementById('password').type == 'password') {document.getElementById('password').type = 'text'; document.getElementById('pwd-eye').className = 'zmdi zmdi-eye closed'; } else {document.getElementById('password').type = 'password'; document.getElementById('pwd-eye').className = 'zmdi zmdi-eye';} return false;"><i class="zmdi zmdi-eye" id="pwd-eye"></i></button>
                </div>
            </div>
            <div class="center">
                <button class="login-btn" type="submit">ACCEDI</button>
            </div>
        </form>
    </div>


    {{--<div class="row">--}}
        {{--<div class="col-md-4 col-md-offset-4">--}}
            {{--<h1 class="text-center">Login</h1>--}}
            {{--<form method="POST" action="/login">--}}
                {{--{!! csrf_field() !!}--}}
                {{--<div class="col-md-12 raw-margin-top-24">--}}
                    {{--<label>Email</label>--}}
                    {{--<input class="form-control" type="email" name="email" value="{{ old('email') }}">--}}
                {{--</div>--}}
                {{--<div class="col-md-12 raw-margin-top-24">--}}
                    {{--<label>Password</label>--}}
                    {{--<input class="form-control" type="password" name="password" id="password">--}}
                {{--</div>--}}
                {{--<div class="col-md-12 raw-margin-top-24">--}}
                    {{--<label>--}}
                        {{--Remember Me <input type="checkbox" name="remember">--}}
                    {{--</label>--}}
                {{--</div>--}}
                {{--<div class="col-md-12 raw-margin-top-24">--}}
                    {{--<a class="btn btn-default pull-left" href="/password/email">Forgot Password</a>--}}
                    {{--<button class="btn btn-primary pull-right" type="submit">Login</button>--}}
                {{--</div>--}}

                {{--<div class="col-md-12 raw-margin-top-24">--}}
                    {{--<a class="btn raw100 btn-info" href="/register">Register</a>--}}
                {{--</div>--}}
            {{--</form>--}}

        {{--</div>--}}
    {{--</div>--}}

@stop

