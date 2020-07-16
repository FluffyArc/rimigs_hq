@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Subject</h1>
        <a class="btn btn-primary" href="{{route('subjectForm')}}" role="button">Add New Subject</a>

        <p class="text-muted">{{session('mssg')}}</p>

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
