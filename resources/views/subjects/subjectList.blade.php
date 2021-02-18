@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Choose Subject</h1>

        @foreach($subjects as $subject)
            <a href="{{route('showQuest',$subject->subject_name)}}" style="text-decoration: none">
            <button type="button" class="btn btn-info btn-lg btn-block">{{$subject->subject_name}}</button>
            </a>
            <br>
        @endforeach
    </div>
@endsection
