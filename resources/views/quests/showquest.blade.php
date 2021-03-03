@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>All Quest</h1>

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
                <th>Title</th>
                <th>Description</th>
                <th>Exp</th>
                <th>Level</th>
                <th>Max Player</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Action</th>
                <th>Update</th>
                <th>Delete</th>
                <?php $no = 1; ?>
                </thead>
                <tbody>
                @foreach($quests as $quest)
                    <tr>
                        <td align="center">{{$no++}}</td>
                        {{--<td>{{$quest->id}}</td>--}}
                        <td>{{$quest->title}}</td>
                        <td>{{$quest->desc}}</td>
                        <td align="center">{{$quest->exp}}</td>
                        <td align="center">{{$quest->level}}</td>
                        <td align="center">{{$quest->max_player}}</td>
                        <td>{{$quest->subject_name}}</td>
                        <td>
                            @if($quest->status == 1)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td align="center">
                            @if(Auth::user()->user_type == 'teacher')
                                <a class="btn btn-primary" href="/showQuestById/{{$quest->id}}/{{$quest->id_subject}}"
                                   role="button">POST</a>
                            @elseif(Auth::user()->user_type == 'assistant')
                                <a class="btn btn-primary disabled" role="button">POST</a>
                            @endif
                        </td>
                        <td align="center">
                            <a class="btn btn-primary" href="/editQuest/{{$quest->id}}" role="button">UPDATE</a>
                        </td>
                        <td align="center">
                            <a class="btn btn-danger" href="/destroyQuest/{{$quest->id}}" role="button">DELETE</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
