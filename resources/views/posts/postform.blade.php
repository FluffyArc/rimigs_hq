@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <form action="/postQuest" method="post">
        @csrf
        <div class="form-group">
            <p>{{session('mssg')}}</p>
            <h1>Post Quest</h1>
            <div class="form-group">
                <label>Student Name</label>
                <select id="studentName" name="studentName" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
        </div>
            <div class="form-group">
                <label>Quest</label>
                <select id="quest" name="quest" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>

        <div class="form-group">
            <label>Quest</label>
            <input type="text" class="form-control" readonly="true" id="questDesc" name="questDesc" placeholder="Quest Description"
                   value="{{$quest->title}}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Expired Date</label>
                <input type="date" class="form-control" id="exp" name="exp" placeholder="Experience Point">
            </div>
            <div class="form-group col-md-6">
                <label>Completed Date</label>
                <input type="date" class="form-control" id="level" name="level" placeholder="Level">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Post Quest</button>
    </form>
@endsection
