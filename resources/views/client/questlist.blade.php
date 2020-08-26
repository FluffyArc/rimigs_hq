@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">

            <div id="quest-content" class="custom-scrollbar-css">
                <h1>Quest Selector</h1>

                @foreach($levels as $level)
                    <div class="button2">
                         <strong>{{$level->title}}</strong>
                    </div>
                @endforeach
            </div>


            <div id="quest-detail">
                <div style="font-family: 'baskvill'; font-size: 24px;"><h1>Quest Detail</h1></div>
                <div style="font-family: 'rageitalic'; font-size: 24px;">
                    He had done everything right. There had been no mistakes throughout the entire process. It had been
                    perfection and he knew it without a doubt, but the results still stared back at him with the fact
                    that he had lost.
                    Her mom had warned her. She had been warned time and again, but she had refused to believe her. She
                    had done everything right and she knew she would be rewarded for doing so with the promotion. So
                    when the promotion was given to her main rival, it not only stung, it threw her belief system into
                    disarray. It was her first big lesson in life, but not the last.
                </div>
            </div>


        </div>

    </center>
@endsection
