@extends('base')
@extends('client.navclient')
@section('content')

    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">
            <div class="questTakenTitle">
                <div class="row">
                    <div class="col-md-12">
                        <h1>{{$quests->title}}</h1>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12 questTakenContent">
                    <h2 style="font-size: 1.2vw; font-family: 'rageitalic'">{{$quests->desc}}</h2>
                </div>
            </div>
            <br>

        </div>
    </center>

@endsection
