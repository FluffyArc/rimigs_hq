@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <form action="{{route('postQuest')}}" method="post">
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
            <h1>Post Quest</h1>
            <div class="form-group">
                <label>Student Name</label>
                <select id="studentName" name="studentName" class="form-control" required="true">
                    <option selected value="">Choose...</option>
                    @foreach($students as $student)
                        <option value="{{$student->id}}">{{$student->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Quest</label>
            <input type="text" class="form-control" readonly="true" id="questDesc" name="questDesc"
                   placeholder="Quest Description"
                   value="{{$quest->title}}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Expired Date</label>
                <input type="input" class="form-control" id="exp" name="expiredDate" placeholder="Experience Point"
                       readonly
                       value="{{$date}}">
            </div>
            <div class="form-group col-md-6">
                <label>Available Player</label>
                <input type="text" class="form-control" id="available" name="available" value="{{$available}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label>Subject</label>
            <input type="input" class="form-control" id="subjectname" name="subjectname" readonly
                   value="{{$subject->subject_name}}">
        </div>
        @if(Auth::user()->user_type == 'teacher')
            <button type="submit" class="btn btn-primary">Post Quest</button>
        @elseif(Auth::user()->user_type == 'assistant')
            <button type="submit" class="btn btn-primary" disabled>Post Quest
        @endif
    </form>
@endsection
