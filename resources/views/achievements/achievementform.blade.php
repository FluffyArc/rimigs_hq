@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')

    <form action="{{route('addAch')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">

            <h1>Add Achievement</h1>
            <label>Achievement Title</label>
            <input type="text" class="form-control" name="achTitle" placeholder="Quest Title">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="desc" placeholder="Quest Description"></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Reward Point</label>
                <input type="number" class="form-control" name="reward" placeholder="Experience Point">
            </div>
            <div class="form-group col-md-3">

            </div>

        </div>
        <div class="form-group">
            <input type="file" name="icon" class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </div>


        <button type="submit" class="btn btn-primary">Add Achievement</button>

    </form>
@endsection
