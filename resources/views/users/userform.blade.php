@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <form action="{{ route('addStudent') }}" method="post">
        @csrf
        <div class="form-group">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        </div>
        <div class="form-group">
            <h1>Add New User</h1>
            <label>Student Name</label>
            <input type="text" class="form-control" id="studentName" name="studentName" placeholder="Name">
        </div>
        <div class="form-group">
            <label>Student Email</label>
            <input type="text" class="form-control" id="studentEmail" name="studentEmail" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                   placeholder="Confirm Password">
        </div>
        @if(Auth::user()->user_type == 'teacher')
            <button type="submit" class="btn btn-primary">Add New Student</button>
        @elseif(Auth::user()->user_type == 'assistant')
            <button type="submit" class="btn btn-primary" disabled>Add New Student</button>
        @endif
    </form>
@endsection
