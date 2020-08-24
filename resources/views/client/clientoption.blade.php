@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">
            <div id="quest-content">
                <img src="{{ asset('img/Dragons.png') }}">
            </div>
            <div id="quest-detail" class="custom-scrollbar-css">
                <p>
                <h1 style="text-align: center; padding-left: 30px; ">Choose an option</h1></p>

                <a href="{{url('https://www.google.com/')}}" class="textInButton">
                    <div class="button" style="background-image: url('img/button.png');">
                        <h2>Take A Quest</h2>
                    </div>
                </a>

             </div>

        </div>

    </center>
@endsection
