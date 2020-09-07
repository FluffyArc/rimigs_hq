@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <div class="login">
            <img src="{{ asset('img/Dragons.png') }}" style="width: 70%">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="StudentName" class="label"><h4>Name</h4></label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror


                </div>
                <div class="form-group">
                    <label for="StudentEmail" class="label"><h4>Email</h4></label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="Password" class="label"><h4>Password</h4></label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ConfirmPassword" class="label"><h4>Confirm Password</h4></label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           required autocomplete="new-password">
                </div>

                <input type="image" id="eggclosed" src="../img/eggsclosed.png" onmouseover="openegg()" class="mt-3">
                <input type="image" id="eggopen" src="../img/egg.png" onmouseout="closeegg()" class="mt-3"
                       style="display: none;">

            </form>
        </div>
    </center>

    <script>
        function openegg() {
            var y = document.getElementById("eggclosed");
            y.style.display = "none"
            var x = document.getElementById("eggopen");
            x.style.display = "block";

        }

        function closeegg() {
            var y = document.getElementById("eggclosed");
            y.style.display = "block"
            var x = document.getElementById("eggopen");
            x.style.display = "none";
        }
    </script>
@endsection
