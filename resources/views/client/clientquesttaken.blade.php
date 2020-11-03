@extends('base')
@extends('client.navclient')
@section('content')

    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">


                    <div class="col-md-12 questTakenTitle">
                        <h1>Quest</h1>
                    </div>

                <br>

                    <div class="col-md-12 questTakenContent">
                        Name: {{Auth::user()->name}}
                    </div>


                    <div class="col-md-11">
                        <table border="1" class="table-quest custom-scrollbar-css">
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
                                    <td align="center">{{++$no}}</td>
                                    <td>
                                        <a href="{{route('detail',$quest->id_quest)}}"
                                           style="text-decoration: none; color: black">
                                            {{$quest->title}}
                                        </a>
                                    </td>
                                    <td align="center">{{\Carbon\Carbon::parse($quest->exp_date)->format('d-M-Y')}}</td>

                                    @if($quest->complete_date == null)
                                        <td align="center">
                                            -
                                        </td>
                                    @else
                                        <td align="center">
                                            {{\Carbon\Carbon::parse($quest->complete_date)->format('d-M-Y')}}
                                        </td>

                                    @endif


                                    @if($quest->ongoing == 0)
                                        <td align="center" width="15%">
                                            <img src="{{asset('../img/quest-clear.png')}}">
                                        </td>
                                    @elseif($quest->ongoing == 1)
                                        <td align="center" width="15%">Ongoing</td>
                                    @elseif($quest->ongoing == 2)
                                        <td align="center" width="15%">
                                            <img src="{{asset('../img/quest-abort.png')}}">
                                        </td>
                                    @elseif($quest->ongoing == 3)
                                        <td align="center" width="15%">
                                            <img src="{{asset('../img/quest-failed.png')}}">
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>




        </div>
    </center>
@endsection
