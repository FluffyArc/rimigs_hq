@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <div class="login">
            <img src="{{ asset('img/Dragons.png') }}" style="width: 70%">
            <form method="POST" action="{{route('clientLogin')}}">
                @csrf
                <div class="form-group">
                    <label for="username" class="label"><h4>Username</h4></label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                           value="{{ old('username') }}" required autocomplete="username" placeholder="Username" autofocus>

                    @error('username')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror


                </div>
                <div class="form-group">
                    <label for="password" class="label"><h2>Password</h2></label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <input type="image" name="submit" src="../img/login.png" class="loginbtn">
                <div class="form-group">
                    <label for="forget_password">
                        <a href="{{route('password.request')}}" style="color: white; text-decoration: underline">Forget Password? Click Here</a>

                    </label>
                    <br>
                    <label for="register">
                        <a href="{{route('register')}}" style="color: white; text-decoration: underline">New User? Click Here To Register</a>
                    </label>
                </div>
            </form>

        </div>
    </center>
@endsection
