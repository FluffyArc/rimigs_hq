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
    <form action="{{route('addQuest')}}" method="post">
        @csrf
        <div class="form-group">

            <h1>Add Quest</h1>
            <label>Quest Title</label>
            <input type="text" class="form-control" id="questTitle" name="questTitle" placeholder="Quest Title">
        </div>
        <div class="form-group">
            <label>Quest Description</label>
            <textarea class="form-control" id="questDesc" name="questDesc" placeholder="Quest Description"></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Experience Point</label>
                <input type="number" class="form-control" id="exp" name="exp" placeholder="Experience Point">
            </div>
            <div class="form-group col-md-3">
                <label>Level</label>
                <input type="number" class="form-control" id="level" name="level" placeholder="Level">
            </div>
            <div class="form-group col-md-3">
                <label>Max Player</label>
                <input type="number" class="form-control" id="maxPlayer" name="maxPlayer" placeholder="Max Player">
            </div>
        </div>
        <div class="form-group">
            <label>Subject</label>
            <select id="subject" name="subject" class="form-control">
                @foreach($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <div class="form-check">

                <input class="form-check-input" type="radio" name="status" id="status" value="1" checked>
                <label class="form-check-label" for="active">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status" value="0">
                <label class="form-check-label" for="inactive">
                    Inactive
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add Quest</button>

    </form>
@endsection
