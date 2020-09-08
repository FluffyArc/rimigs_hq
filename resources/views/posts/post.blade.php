@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Post</h1>
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
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead align="center">
                <th>No</th>
                <th>Student Name</th>
                <th>Quest Title</th>
                <th>Subject</th>
                <th>Exp Date</th>
                <th>Complete Date</th>
                <th>Ongoing</th>
                <th>Action</th>
                <?php $no = 1; ?>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$post->name}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->subject_name}}</td>
                        <td>{{date('d-M-Y'), strtotime($post->exp_date)}}</td>
                        <td>{{$post->complete_date}}</td>
                        @if($post->ongoing == 0)
                            <td align="center"><img src="{{asset('../img/complete-stamp.png')}}" width="100px"></td>
                        @elseif($post->ongoing == 1)
                            <td align="center"><img src="{{asset('../img/ongoing-stamp.png')}}" width="100px"></td>
                        @elseif($post->ongoing == 2)
                            <td align="center"><img src="{{asset('../img/abort-stamp.png')}}" width="100px"></td>
                        @elseif($post->ongoing == 3)
                            <td align="center"><img src="{{asset('../img/failed-stamp.png')}}" width="100px"></td>
                        @endif
                        <td align="center">
                            @if($post->ongoing == 1)
                                <a href="{{route('postgrade', $post->id)}}">
                                    <button class="btn btn-primary">Grade</button>
                                </a>
                            @else
                                <button class="btn btn-primary" disabled>Grade</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
