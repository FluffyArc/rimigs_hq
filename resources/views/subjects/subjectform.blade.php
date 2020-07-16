@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <form action="/addSubject" method="post">
        @csrf
        <div class="form-group">
            <h1>Add Subject</h1>
            <label>Subject Name</label>
            <input type="text" class="form-control" id="subjectName" name="subjectName" placeholder="Subject Name">
        </div>
        <div class="form-group">
            <label>Subject Credit</label>
            <input type="number" class="form-control" id="credit" name="credit" placeholder="Subject Credit">
        </div>
        <button type="submit" class="btn btn-primary">Add Subject</button>
    </form>
@endsection
