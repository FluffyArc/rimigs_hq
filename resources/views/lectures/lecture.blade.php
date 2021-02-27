@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Lectures</h1>

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
        <a href="{{route('lectureForm')}}">
            <button type="button" class="btn btn-primary">Add New Lectures</button>
        </a>

        <div class="table-responsive" style="margin-top: 1%">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead align="center">
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Subject</th>
                <th>Action</th>
                </thead>
                <tbody>
                @foreach($lectures as $lecture)
                    <tr>
                        <td align="center">{{$no++}}</td>
                        <td>{{$lecture->title}}</td>
                        <td>{{substr($lecture->desc,0, 100)."..."}}</td>
                        <td align="center">{{$lecture->subject_name}}</td>
                        <td align="center">
                            <a href="{{route('editLecture',$lecture->id)}}">
                                <button type="button" class="btn btn-primary">UPDATE</button>
                            </a>
                            <a href="{{route('destroyLecture',$lecture->id)}}">
                                <button type="button" class="btn btn-danger">DELETE</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
