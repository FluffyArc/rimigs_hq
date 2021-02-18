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
                                <th>Status</th>
                                <th>Action</th>
                                <?php $no = 0; ?>
                            </tr>
                            @foreach($quests as $quest)
                                <tr>
                                    <td align="center">{{++$no}}</td>
                                    <td>
                                            {{$quest->title}}

                                    </td>

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
                                    <td width="25%" align="center">
                                        <a href="{{route('detail',$quest->id_quest)}}"
                                           style="text-decoration: none; color: black">
                                            <img src="{{asset('../img/detail-button.png')}}">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>




        </div>
    </center>
@endsection
