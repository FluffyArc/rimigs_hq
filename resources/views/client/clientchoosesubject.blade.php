@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage.png') }}" class="questPageImage">
            <div class="col-md-12 subject-header">
                <h1>Choose Subject</h1>
            </div>

            <div class="subject-content custom-scrollbar-css">

                @foreach($subjects as $subject)
                    <div class="subject-btn">
                        <a href="{{route('questLevel',$subject->subject_name)}}" style="text-decoration: none; color: black">
                            <img src="../img/button.png" style="width: 50%">
                            <strong class="subject-text">{{$subject->subject_name}}</strong>
                        </a>

                    </div>
                @endforeach


            </div>


            {{-- @foreach(json_decode($details) as $detail)
                 <p>{{$detail->id}} - {{$detail->desc}}</p>
             @endforeach--}}



            {{--<div class="col-md-12 subject-button">
                <img src="../img/button.png" style="width: 40%">
            </div>
            <h2 class="subject-text">Pemrograman Web</h2>--}}
        </div>
    </center>
@endsection
