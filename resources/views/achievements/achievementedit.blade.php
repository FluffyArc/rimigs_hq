@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')

    <form action="{{route('updateAch', $ach->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">

            <h1>Add Achievement</h1>
            <label>Achievement Title</label>
            <input type="text" class="form-control" name="achTitle" placeholder="Quest Title" value="{{$ach->ach_title}}">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="desc" placeholder="Quest Description">{{$ach->ach_desc}}</textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Reward Point</label>
                <input type="number" class="form-control" name="reward" placeholder="Experience Point" value="{{$ach->hr_reward}}">
            </div>
            <div class="form-group col-md-3">

            </div>

        </div>
        <div class="form-group">
            <input type="file" name="icon" class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </div>


        <button type="submit" class="btn btn-primary">Update Achievement</button>

    </form>
@endsection
