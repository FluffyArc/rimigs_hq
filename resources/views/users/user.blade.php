@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Students List</h1>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <?php $no = 1; ?>
                </thead>

            </table>
        </div>
    </div>
@endsection
