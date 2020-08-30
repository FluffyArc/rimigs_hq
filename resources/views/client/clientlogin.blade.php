@extends('base')
@extends('client.navclient')
@section('content')
<center>
	<link rel = "stylesheet" href= "{{asset('css/bootstrap.min.css')}}">
	<div class="login">
		<img src="{{ asset('img/Dragons.png') }}" style="width: 70%">
		<form method="POST" action="{{route('clientLogin')}}">
            @csrf
  			<div class="form-group">
    			<label for="email" class="label"><h2>Email</h2></label>
    			<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

  			</div>
  			<div class="form-group">
    			<label for="password" class="label"><h2>Password</h2></label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
  			</div>
            <input type="image" name="submit" src="../img/login.png" class="loginbtn">
  		</form>
	</div>
</center>
@endsection
