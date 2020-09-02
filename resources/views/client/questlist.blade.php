@extends('base')
@extends('client.navclient')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">

            <div id="quest-content" class="custom-scrollbar-css">
                <h1>Quest Selector</h1>

                @foreach($levels as $level)
                    <div class="button2" id="quest" onclick="questClick({{$level->id}})">
                        <strong>
                            {{$level->title}}
                            {{--{{$loop->index}}--}}
                        </strong>
                    </div>
                @endforeach

                {{-- @foreach(json_decode($details) as $detail)
                     <p>{{$detail->id}} - {{$detail->desc}}</p>
                 @endforeach--}}


            </div>


            <div id="quest-detail">
                <div style="font-family: 'baskvill'; font-size: 24px;"><h1>Quest Detail</h1></div>
                <div style="font-family: 'rageitalic'; font-size: 24px;">
                    {{--He had done everything right. There had been no mistakes throughout the entire process. It had been
                    perfection and he knew it without a doubt, but the results still stared back at him with the fact
                    that he had lost.
                    Her mom had warned her. She had been warned time and again, but she had refused to believe her. She
                    had done everything right and she knew she would be rewarded for doing so with the promotion. So
                    when the promotion was given to her main rival, it not only stung, it threw her belief system into
                    disarray. It was her first big lesson in life, but not the last.--}}

                    <div id="questDetail">

                    </div>
                </div>

                <div class="container">
                    <img src="../img/post-button.png" class="btn-post" id="btn-post"  onclick="postQuest()">

                </div>



            </div>

        </div>

        <script>
            var id;
            var exp;
            var days_required;
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
                        exp = data["exp"];
                        days_required = data["days_required"];
                        document.getElementById('questDetail').innerHTML = data["desc"];
                        document.getElementById('btn-post').style.display = "block";
                        document.getElementById('post-text').style.display = "block";
                        //alert('success').html(data);
                    },
                    error: function (response) {
                        console.log(data)
                    }


                });
                //document.getElementById('questDetail').innerHTML =


            }

            function postQuest(){
                $.ajax({
                    url: '{{url('questPost')}}',
                    type: 'POST',
                    data: {
                      id_user: {{Auth::user()->id}},
                        id_quest: id,
                        exp_date: days_required,

                        exp: exp,
                     },
                    success:function (data){
                        alert(data.success);
                        //console.log(data)
                    },
                    error: function (response) {
                        console.log(data)
                    }
                });
            }
        </script>

    </center>
@endsection
