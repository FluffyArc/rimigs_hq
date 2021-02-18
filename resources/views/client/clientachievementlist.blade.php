@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage-2.png') }}" class="questPageImage-2">
            <div class="col-md-12">
                <img src="{{asset('img/achievements.png')}}" class="achlist-header img">
            </div>
            <div id="ach-list" class="custom-scrollbar-css">
                <div class="col-md-12">
                    <table border="0" class="ach-list-table">
                        @foreach($ach as $data)
                                <tr>
                                    <td rowspan="4">
                                        <img src="../upload/icon/{{$data->ach_icon}}" class="icon-ach">
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{$data->ach_title}}</td>
                                </tr>
                                <tr>
                                    <td>{{$data->ach_desc}}</td>
                                </tr>
                                <tr>
                                    <td>{{$data->hr_reward}}</td>
                                </tr>

                        @endforeach
                    </table>


                </div>
            </div>

    </center>
@endsection
