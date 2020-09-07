@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage-2.png') }}" class="questPageImage-2">
            <div class="col-md-12">
                <img src="../img/user-profile.png" class="profile-header">
            </div>
            <div class="col-md-12">
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
                    <tr>
                        <td colspan="2">Subjects</td>
                    </tr>
                    @foreach($subjects as $subject)
                        <tr>
                            <td colspan="2">{{$subject->subject_name}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">
                            <a href="{{route('changepass')}}">
                                <img src="{{asset('../img/change-pass-button.png')}}" class="change-pass-button">
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </center>
@endsection
