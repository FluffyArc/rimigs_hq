@extends('base')
@extends('client.navclient')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">

            <div id="quest-content" class="custom-scrollbar-css">
                <h1 style="font-family: 'baskvill'; font-size: 2vw">Quest Selector</h1>

                @foreach($levels as $level)
                    <div class="button2" id="quest" onclick="questClick({{$level->id}})">
                        <strong style="font-size: 1.3vw; font-family: 'rageitalic';">
                            {{$level->title}}
                            {{--{{$loop->index}}--}}
                        </strong>


                    </div>
                @endforeach

                {{-- @foreach(json_decode($details) as $detail)
                     <p>{{$detail->id}} - {{$detail->desc}}</p>
                 @endforeach--}}


            </div>




            <div id="quest-detail" class="custom-scrollbar-css">
                <div style="font-family: 'baskvill'; font-size: 1.5vw;"><h1>Quest Detail</h1></div>
                <div style="font-family: 'papyrus'; font-size: 1.2vw;">


                    <div id="questDetail">

                    </div>
                </div>

                <div class="container">
                    <h2 id="exp" style="font-family: 'papyrus'; font-size: 1.5vw;"></h2>
                    <img src="{{asset('../img/post-button.png')}}" class="btn-post" id="btn-post"  onclick="postQuest()">

                    <h2 id="available" style="font-family: 'papyrus'; font-size: 1.5vw;"></h2>
                </div>
            </div>

        </div>

        <script>


            var id;
            var exp;
            var days_required;
            var id_subject;
            function questClick(val) {
                id = val;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{url('questDetail')}}',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        //exp = data.details["exp"];
                        days_required = data.details["days_required"];
                        id_subject = data.details["id_subject"];
                        document.getElementById('questDetail').innerHTML = data.details["desc"];
                        //document.getElementById('exp').innerHTML = "Exp: "+data.details["exp"];
                        document.getElementById('available').innerHTML = "Available: "+data.available;

                        document.getElementById('btn-post').style.display = "block";
                        //document.getElementById('post-text').style.display = "block";
                        //alert('success').html(data);
                    },
                    error: function (response) {
                        console.log(data)
                    }


                });
                //document.getElementById('questDetail').innerHTML =


            }

            function postQuest(){
                swal({
                    title: "Post This Quest?",
                    text: "If you feel this quest is to difficult, feel free to abort it",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{url('questPost')}}',
                                type: 'POST',
                                data: {
                                    id_user: {{Auth::user()->id}},
                                    id_quest: id,
                                    exp_date: days_required,

                                    exp: exp,
                                    id_subject: id_subject,
                                },
                                success:function (data){
                                    if(data.failed){
                                        swal(data.failed, {
                                            icon: "error",
                                        });
                                    }else if(data.success){
                                        swal(data.success, {
                                            icon: "success",
                                        });
                                        console.log(data.success)
                                    }

                                    //alert(data.success);
                                    //console.log(data)
                                },
                                error: function (response) {
                                    console.log(data)
                                }
                            });

                        } else {
                            swal("Feel free to look on other quests");
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

    </center>
@endsection
