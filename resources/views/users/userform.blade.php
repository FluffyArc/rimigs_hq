@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <form action="/addStudent" method="post">
        @csrf
        <div class="form-group">
            <p>{{session('mssg')}}</p>
            <h1>Add New User</h1>
            <label>Student Name</label>
            <input type="text" class="form-control" id="studentName" name="studentName" placeholder="Name">
        </div>
        <div class="form-group">
            <label>Student Email</label>
            <input type="text" class="form-control" id="studentEmail" name="studentEmail" placeholder="Email">
        </div>

        <button type="submit" class="btn btn-primary">Add New Student</button>
    </form>
@endsection
