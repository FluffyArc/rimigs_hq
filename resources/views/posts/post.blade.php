@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Post</h1>
        <a class="btn btn-primary" href="{{route('subjectForm')}}" role="button">Add New Post</a>

        <p class="text-muted">{{session('mssg')}}</p>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <th>No</th>
                <th>Student Name</th>
                <th>Quest Title</th>
                <th>Exp Date</th>
                <th>Complete Date</th>
                <th>Ongoing</th>
                <?php $no = 1; ?>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection
