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

            <div class="row">
                <div class="col-md-12">
                    <img src="../img/abort-button.png" class="abort-button" onclick="abortQuest({{$quests->id}})">

                </div>
            </div>
            <br>

        </div>
        <script type="text/javascript">
            var iduser;
            var idquest;
            function abortQuest(idQuest) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                idquest = idQuest;

                $.ajax({
                    url: '{{url('abort')}}',
                    type: 'POST',
                    data: {
                        idQuest: idquest
                    },
                    success: function(data) {
                        alert(data.success);
                        //console.log(data["id"])
                        //alert('success').html(data);
                    },
                    error: function (response) {
                        //console.log(idquest)
                        console.log(data)
                    }


                });

            }


        </script>
    </center>


@endsection
