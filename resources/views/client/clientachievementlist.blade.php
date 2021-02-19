@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">

                <div class="col-md-12">
                    <img src="{{asset('img/achievements.png')}}" class="achlist-header img">
                </div>
                <div id="ach-list" class="custom-scrollbar-css">
                    <div class="col-md-12">

                        @foreach($ach as $data)
                            <div class="box">
                                <table border="0" class="ach-list-table" >

                                    <tr>
                                        <td rowspan="4" style="width: 25%">
                                            <img src="../upload/icon/{{$data->ach_icon}}" class="icon-ach">
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <strong>
                                                {{$data->ach_title}}
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{$data->ach_desc}}</td>
                                    </tr>
                                    <tr>
                                        <td>Reward: +{{$data->hr_reward}} exp</td>
                                    </tr>


                                </table>
                            </div>

                            {{-- <table border="1" class="ach-list-table" >

                                     <tr>
                                         <td rowspan="4" style="width: 25%">
                                             <img src="../upload/icon/{{$data->ach_icon}}" class="icon-ach">
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>{{$data->ach_title}}</td>
                                     </tr>
                                     <tr>
                                         <td>{{$data->ach_desc}}</td>
                                     </tr>
                                     <tr style="margin-bottom: {{$top+=150}}%">
                                         <td>{{$data->hr_reward}}</td>
                                     </tr>


                             </table>--}}
                        @endforeach




                    </div>
                </div>



    </center>
@endsection
