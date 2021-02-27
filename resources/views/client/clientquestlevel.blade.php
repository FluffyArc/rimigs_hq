@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">
            <div id="quest-content">
                <img src="{{ asset('img/Dragons.png') }}" class="dragonLogo">
            </div>
            <div id="lecture-list" class="custom-scrollbar-css">
                <h1 style="text-align: center; font-size: 2vw; ">Class Material</h1>
                @foreach($lectures as $lecture)
                    <a href="{{route('clientlecture',$lecture->id)}}" style="text-decoration: none; color: black">
                    <div class="button-lecture" id="lecture-title">
                        <strong style="font-size: 1.3vw; font-family: 'rageitalic';">
                            {{$lecture->title}}
                            {{--{{$loop->index}}--}}
                        </strong>


                    </div>
                    </a>
                @endforeach
            </div>
            <div id="quest-detail" class="custom-scrollbar-css">
                <h1 style="text-align: center; font-size: 2vw; ">Choose a level</h1><br>
                @if($level <= 5)
                    <div class="button">
                        <a href="{{route('questList',[1,$subject])}}">
                            <img src="../img/level-1.png" class="level">
                        </a>
                    </div>
                @endif
                @if($level >= 6 && $level <=8)
                    <div class="button">
                        <a href="{{route('questList',[1,$subject])}}">
                            <img src="../img/level-1.png" class="level">
                        </a>
                    </div>
                    <div class="button">
                        <a href="{{route('questList',[2, $subject])}}">
                            <img src="../img/level-2.png" class="level">
                        </a>
                    </div>
                @endif
                @if($level >= 9 && $level <=11)
                    <div class="button">
                        <a href="{{route('questList',[1,$subject])}}">
                            <img src="../img/level-1.png" class="level">
                        </a>
                    </div>
                    <div class="button">
                        <a href="{{route('questList',[2, $subject])}}">
                            <img src="../img/level-2.png" class="level">
                        </a>
                    </div>
                    <div class="button">
                        <a href="{{route('questList',[3, $subject])}}">
                            <img src="../img/level-3.png" class="level">
                        </a>
                    </div>
                @endif
                @if($level >= 12 && $level <= 14)
                    <div class="button">
                        <a href="{{route('questList',[1,$subject])}}">
                            <img src="../img/level-1.png" class="level">
                        </a>
                    </div>
                    <div class="button">
                        <a href="{{route('questList',[2, $subject])}}">
                            <img src="../img/level-2.png" class="level">
                        </a>
                    </div>
                    <div class="button">
                        <a href="{{route('questList',[3, $subject])}}">
                            <img src="../img/level-3.png" class="level">
                        </a>
                    </div>
                    <div class="button">
                        <a href="{{route('questList',[4, $subject])}}">
                            <img src="../img/level-4.png" class="level">
                        </a>
                    </div>
                @endif
                @if($level >= 15)
                    <div class="button">
                        <a href="{{route('questList',[1,$subject])}}">
                            <img src="../img/level-1.png" class="level">
                        </a>
                    </div>
                    <div class="button">
                        <a href="{{route('questList',[2, $subject])}}">
                            <img src="../img/level-2.png" class="level">
                        </a>
                    </div>
                    <div class="button">
                        <a href="{{route('questList',[3, $subject])}}">
                            <img src="../img/level-3.png" class="level">
                        </a>
                    </div>
                    <div class="button">
                        <a href="{{route('questList',[4, $subject])}}">
                            <img src="../img/level-4.png" class="level">
                        </a>
                    </div>
                    <div class="button">
                        <a href="{{route('questList',[5, $subject])}}">
                            <img src="../img/level-5.png" class="level">
                        </a>
                    </div>
                @endif


            </div>

        </div>
       {{-- <script>
            function levelAlert() {
                swal({
                    title: "Ummm!",
                    text: "Why don't you try to solve quests on your level.",
                    icon: "error",
                    button: "Ok, I'll try",
                });
            }
        </script>--}}
    </center>


@endsection
