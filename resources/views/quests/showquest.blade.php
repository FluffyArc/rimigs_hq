@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>All Quest</h1>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead align="center">
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Exp</th>
                <th>Level</th>
                <th>Max Player</th>
                <th>Days Required</th>
                <th>Subject</th>
                <th>Action</th>
                <th>Update</th>
                <?php $no = 1; ?>
                </thead>
                <tbody>
                @foreach($quests as $quest)
                    <tr>
                        <td align="center">{{$no++}}</td>
                        <td>{{$quest->title}}</td>
                        <td>{{$quest->desc}}</td>
                        <td align="center">{{$quest->exp}}</td>
                        <td align="center">{{$quest->level}}</td>
                        <td align="center">{{$quest->max_player}}</td>
                        <td align="center">{{$quest->days_required}}</td>
                        <td>{{$quest->subject->subject_name}}</td>
                        <td align="center">
                            <a class="btn btn-primary" href="/showQuestById/{{$quest->id}}" role="button">POST</a>
                        </td>
                        <td align="center">
                            <a class="btn btn-primary" href="/editQuest/{{$quest->id}}" role="button">UPDATE</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
