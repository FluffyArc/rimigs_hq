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


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <th>No</th>
                <th>Subject Name</th>
                <th>Subject Credit</th>
                <?php $no = 1; ?>
                </thead>
                <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$subject->subject_name}}</td>
                        <td>{{$subject->credit}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
