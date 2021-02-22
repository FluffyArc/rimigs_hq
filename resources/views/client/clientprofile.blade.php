@extends('base')
@extends('client.navclient')
@section('content')\

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
                        <td>Name</td>
                        <td>{{Auth::user()->name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{Auth::user()->email}}</td>
                    </tr>
                    <tr>
                        <td>Hunter Rank</td>
                        <td>{{Auth::user()->exp}}</td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        @if(Auth::user()->exp <= 20)
                            <td>1</td>
                        @elseif(Auth::user()->exp > 20 && Auth::user()->exp <=40)
                            <td>2</td>
                        @elseif(Auth::user()->exp > 40 && Auth::user()->exp <=60)
                            <td>3</td>
                        @elseif(Auth::user()->exp > 60 && Auth::user()->exp <=80)
                            <td>4</td>
                        @elseif(Auth::user()->exp > 80)
                            <td>5</td>
                        @endif

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

                <table border="0" class="ach-table">
                    @foreach($receives as $receive)
                        <tr>
                            <td style="width: 20%">
                                <img src="{{asset('../upload/icon/'.$receive->ach_icon)}}" class="receive-ach">
                            </td>
                            <td>{{$receive->ach_title}}</td>
                            <td style="width: 25%">
                                <div onclick="achievementAcquire({{$receive->id}})">
                                    <img src="{{asset('../img/receive.png')}}" class="receive-button">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <a href="{{route('changeProfile',Auth::user()->id)}}">
                <img src="{{asset('../img/change-profile.png')}}" class="change-pass-button">
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
