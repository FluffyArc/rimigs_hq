@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <div class="edit-profile-form">
            <div class="col-md-12">
                <img src="{{asset('img/user-profile.png')}}" style="width: 100%;">
            </div>
            <img src="../upload/avatar/{{Auth::user()->avatar}}" class="edit-avatar">

            <form method="POST" action="{{route('updateProfile')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label><h4>Name</h4></label>
                    <input id="name" type="text" class="form-control" name="name" required autocomplete="name"  autofocus value="{{$user->name}}">

                    <label><h4>Email</h4></label>
                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email"  autofocus value="{{$user->email}}">

                    <label><h4>Username</h4></label>
                    <input id="username" type="text" class="form-control" name="username" required autocomplete="username"  autofocus value="{{$user->username}}">


                </div>



                <input type="file" name="avatar" class="form-group choose-avatar">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <input type="submit" class="btn btn-primary" value="SUbmit">
            </form>

        </div>
    </center>
@endsection
