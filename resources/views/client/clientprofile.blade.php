@extends('base')
@extends('client.navclient')
@section('content')

    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">
            <div class="col-md-12">
                <img src="{{asset('img/user-profile.png')}}" class="profile-header">
            </div>
            <div class="col-md-12">
                <img src="../upload/avatar/{{Auth::user()->avatar}}" class="avatar">
                <table border="0" class="profile-table">
                    <tr>
                        <td width="30%"><strong>Name</strong></td>
                        <td>{{Auth::user()->name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{Auth::user()->email}}</td>
                    </tr>
                    <tr>
                        <td><strong>HR</strong></td>
                        <td>{{$hr}}</td>
                    </tr>
                    <tr>
                        <td><strong>Level</strong></td>
                        @if($completedQuests <= 5)
                            <td>1</td>
                        @elseif($completedQuests >= 6 && $completedQuests <=8)
                            <td>2</td>
                        @elseif($completedQuests >= 9 && $completedQuests <=11)
                            <td>3</td>
                        @elseif($completedQuests >= 12 && Auth::user()->exp <=14)
                            <td>4</td>
                        @elseif($completedQuests >= 15)
                            <td>5</td>
                        @endif

                    </tr>
                    <tr>
                        <td>
                            <div id="progressbar"></div>
                        </td>
                    </tr>
                    {{--<tr>
                        <td colspan="2">Subjects</td>
                    </tr>
                    @foreach($subjects as $subject)
                        <tr>
                            <td colspan="2">{{$subject->subject_name}}</td>
                        </tr>
                    @endforeach--}}

                </table>


            </div>

            <div class="col-md-12">
                <img src="{{asset('img/achievements.png')}}" class="achievements-header">

                    <table border="0" class="ach-table custom-scrollbar-css">

                        @foreach($achs as $ach)
                            <tr>
                                <td style="width: 20%">
                                    <img src="{{asset('../upload/icon/'.$ach->ach_icon)}}" class="receive-ach">
                                </td>
                                <td>{{$ach->ach_title}}</td>
                                <td style="width: 25%">
                                    Reward: +{{$ach->hr_reward}}
                                </td>
                                {{-- <td style="width: 25%">
                                     @if($check_ach_1->id_ach == $ach->id || $check_ach_2->id_ach == $ach->id)
                                         <div>
                                             <img src="{{asset('../img/received.png')}}" class="receive-button">

                                         </div>
                                     @else
                                         <div onclick="achievementAcquire({{$ach->id}})">
                                             <img src="{{asset('../img/receive.png')}}" class="receive-button">

                                         </div>
                                     @endif

                                 </td>--}}
                            </tr>
                        @endforeach

                    </table>


            </div>

            <a href="{{route('changeProfile',Auth::user()->id)}}">
                <img src="{{asset('../img/change-profile.png')}}" class="change-profile-button">
            </a>
        </div>
    </center>

    <script>
        var id_ach;

        function achievementAcquire(id) {
            id_ach = id;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{url('receivedAch')}}',
                type: 'POST',
                data: {
                    id_ach: id_ach
                },
                success: function (data) {
                    if (data.failed) {
                        swal(data.failed, {
                            icon: "error",
                        });
                    } else if (data.success) {
                        swal(data.success, {
                            icon: "success",
                            function() {
                                location.reload();
                            }
                        });

                        console.log(data.success)
                    }

                    //alert(data.success);
                    //console.log(data)
                },
                error: function (response) {
                    console.log(response)
                }
            });

            /*$.ajax({
                url: '{{--{{url('questPost')}}--}}',
                    type: 'POST',
                    data: {
                      id_user: {{--{{Auth::user()->id}}--}},
                        id_quest: id,
                        exp_date: days_required,

                        exp: exp,
                        id_subject: id_subject,
                     },
                    success:function (data){
                        alert(data.success);
                        //console.log(data)
                    },
                    error: function (response) {
                        console.log(data)
                    }
                });*/
        }

    </script>


@endsection
