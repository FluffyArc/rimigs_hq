@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">
            <div id="quest-content">
                <img src="{{ asset('img/Dragons.png') }}" class="dragonLogo">
            </div>
            <div id="quest-detail" class="custom-scrollbar-css">
                <h1 style="text-align: center; padding-left: 30px; ">Choose a level</h1>
                @if($level->exp <= 20)
                    <div class="button">
                        <a href="questList/1">
                            <img src="img/level-1.png" class="level">
                        </a>
                    </div>
                @endif
                @if($level->exp > 20 && $level->exp <=40)
                    <div class="button">
                        <a href="questList/1">
                            <img src="img/level-1.png" class="level">
                        </a>
                    </div>
                    <div class="button">
                        <a href="questList/2">
                            <img src="img/level-2.png" class="level">
                        </a>
                    </div>
                @endif
                @if($level->exp > 40 && $level->exp <=60)
                    <div class="button">
                        <img src="img/level-1.png" class="level">
                    </div>
                    <div class="button">
                        <img src="img/level-2.png" class="level">
                    </div>
                    <div class="button">
                        <img src="img/level-3.png" class="level">
                    </div>
                @endif
                @if($level->exp > 60 && $level->exp <= 80)
                    <div class="button">
                        <img src="img/level-1.png" class="level">
                    </div>
                    <div class="button">
                        <img src="img/level-2.png" class="level">
                    </div>
                    <div class="button">
                        <img src="img/level-3.png" class="level">
                    </div>
                    <div class="button">
                        <img src="img/level-4.png" class="level">
                    </div>
                @endif
                @if($level->exp > 80)
                    <div class="button">
                        <img src="img/level-1.png" class="level">
                    </div>
                    <div class="button">
                        <img src="img/level-2.png" class="level">
                    </div>
                    <div class="button">
                        <img src="img/level-3.png" class="level">
                    </div>
                    <div class="button">
                        <img src="img/level-4.png" class="level">
                    </div>
                    <div class="button">
                        <img src="img/level-5.png" class="level">
                    </div>
                @endif
            </div>

        </div>

    </center>
@endsection
