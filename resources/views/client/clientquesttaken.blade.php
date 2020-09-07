@extends('base')
@extends('client.navclient')
@section('content')

    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 questTakenTitle">
                        <h1>Quest</h1>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 questTakenContent">
                        Name: {{Auth::user()->name}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11">
                        <table border="1" class="table-quest">
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Expired Date</th>
                                <th>Completed Date</th>
                                <th>Status</th>
                                <?php $no = 0; ?>
                            </tr>
                            @foreach($quests as $quest)
                                <tr>
                                    <td>{{++$no}}</td>
                                    <td>
                                        <a href="{{route('detail',$quest->id_quest)}}"
                                           style="text-decoration: none; color: black">
                                            {{$quest->title}}
                                        </a>
                                    </td>
                                    <td>{{date('d-m-Y', strtotime($quest->exp_date))}}</td>
                                    <td>{{$quest->complete_date}}</td>
                                    @if($quest->ongoing == 0)
                                        <td>Completed</td>
                                    @elseif($quest->ongoing == 1)
                                        <td>Ongoing</td>
                                    @elseif($quest->ongoing == 2)
                                        <td>Aborted/Failed</td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </center>
@endsection
