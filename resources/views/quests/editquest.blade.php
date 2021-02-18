@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <form action="{{route('updateQuest', $quests->id)}}" method="post">
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
            <h1>Edit Quest</h1>
            <label>Quest Title</label>
            <input type="text" class="form-control" id="questTitle" name="questTitle" placeholder="Quest Title" value="{{$quests->title}}">
        </div>
        <div class="form-group">
            <label>Quest Description</label>
            <textarea class="form-control" id="questDesc" name="questDesc" placeholder="Quest Description">{{$quests->desc}}</textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Experience Point</label>
                <input type="number" class="form-control" id="exp" name="exp" placeholder="Experience Point" value="{{$quests->exp}}">
            </div>
            <div class="form-group col-md-3">
                <label>Level</label>
                <input type="number" class="form-control" id="level" name="level" placeholder="Level" value="{{$quests->level}}">
            </div>
            <div class="form-group col-md-3">
                <label>Max Player</label>
                <input type="number" class="form-control" id="maxPlayer" name="maxPlayer" placeholder="Max Player" value="{{$quests->max_player}}">
            </div>

        </div>
        <div class="form-group">
            <label>Subject</label>
            <select id="subject" name="subject" class="form-control">
                <option value="{{$selectedSubject->id}}" selected>{{$selectedSubject->subject_name}}</option>
                @foreach($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Quest</button>
    </form>
@endsection
