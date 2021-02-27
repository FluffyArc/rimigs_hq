@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">

            <div class="lecture-content custom-scrollbar-css">
                <h1>{{$lecture->title}}</h1>

                <div class="lecture-desc">
                    {!! $lecture->desc !!}

                </div>
            </div>
        </div>
    </center>
@endsection
