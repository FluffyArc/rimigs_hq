@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Subject</h1>
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

        @if(Auth::user()->user_type == 'teacher')
            <a class="btn btn-primary" href="{{route('subjectForm')}}" role="button">Add New Subject</a>
        @elseif(Auth::user()->user_type == 'assistant')
            <a class="btn btn-primary disabled" role="button">Add New Subject</a>
        @endif


        <div class="table-responsive" style="margin-top: 1%">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead align="center">
                <th>No</th>
                <th>Subject Name</th>
                <th>Subject Credit</th>
                <th>Status</th>
                <th>Action</th>
                </thead>
                <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <td align="center">{{$no++}}</td>
                        <td>{{$subject->subject_name}}</td>
                        <td align="center">{{$subject->credit}}</td>
                        <td align="center">
                            @if($subject->active == 1)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td align="center" style="width: 20%">
                            <a href="{{route('editSubject', $subject->id)}}">
                                <button type="button" class="btn btn-primary">UPDATE</button>
                            </a>
                            <a href="{{route('destroySubject',$subject->id)}}">
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
