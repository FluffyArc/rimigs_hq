@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
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
    <form action="{{route('addLecture')}}" method="post">
        @csrf
        <div class="form-group">

            <h1>Add Lecture</h1>
            <label>Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Quest Title">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="desc" name="desc" placeholder="Quest Description" rows="10"></textarea>
        </div>

        <div class="form-group">
            <label>Subject</label>
            <select id="subject" name="subject" class="form-control">
                @foreach($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Quest</button>

    </form>
@endsection
