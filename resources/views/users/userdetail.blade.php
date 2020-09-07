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
                <th>Hunter Rank</th>
                <?php $no = 1; ?>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->exp}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
