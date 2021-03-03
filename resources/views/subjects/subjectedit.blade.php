@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <form method="post" action="{{route('updateSubject',$subject->id)}}">
        @csrf
        <div class="form-group">
            <h1>Add Subject</h1>
            <label>Subject Name</label>
            <input type="text" class="form-control" id="subjectName" name="subjectName" placeholder="Subject Name"
                   value="{{$subject->subject_name}}">
        </div>
        <div class="form-group">
            <label>Subject Credit</label>
            <input type="number" class="form-control" id="credit" name="credit" placeholder="Subject Credit"
                   value="{{$subject->credit}}">
        </div>
        <div class="form-group">
            <label>Status</label>
            <div class="form-check">
                @if($subject->active == 1)
                    <input class="form-check-input" type="radio" name="status" id="status" value="1" checked>
                @else
                    <input class="form-check-input" type="radio" name="status" id="status" value="1">
                @endif
                <label class="form-check-label" for="active">
                    Active
                </label>
            </div>
            <div class="form-check">
                @if($subject->active == 0)
                    <input class="form-check-input" type="radio" name="status" id="status" value="0" checked>
                @else
                    <input class="form-check-input" type="radio" name="status" id="status" value="0">
                @endif
                <label class="form-check-label" for="inactive">
                    Inactive
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Add Subject</button>


    </form>
@endsection
