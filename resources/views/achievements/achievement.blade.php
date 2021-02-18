@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Achievements</h1>

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
        <a href="{{route('form')}}">
            <button type="button" class="btn btn-primary">Add New Achievement</button>
        </a>

        <div class="table-responsive" style="margin-top: 1%">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead align="center">
                <th>No</th>
                <th>Achievement Title</th>
                <th>Description</th>
                <th>Reward</th>
                <th>Icon</th>
                <th>Action</th>
                <?php $no = 1; ?>
                </thead>
                <tbody>
                @foreach($achs as $ach)
                    <tr>
                        <td align="center">{{$no++}}</td>
                        <td>{{$ach->ach_title}}</td>
                        <td>{{$ach->ach_desc}}</td>
                        <td align="center">{{$ach->hr_reward}}</td>
                        <td align="center"><img src="{{asset('upload/icon/'.$ach->ach_icon)}}"></td>
                        <td align="center">
                            <a href="{{route('achEdit',$ach->id)}}">
                                <button type="button" class="btn btn-primary">UPDATE</button>
                            </a>
                            <a href="{{route('destroyAch', $ach->id)}}">
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
