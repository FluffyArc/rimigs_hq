@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Post</h1>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="dropdown">
            <select class="btn btn-secondary dropdown-toggle" onchange="selectSubject()" id="subjects">
                <option value="" disabled selected>-Select Subjects-</option>
                <br>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                    @foreach($subjects as $subject)
                        <option value="{{$subject->subject_name}}">{{$subject->subject_name}}</option>
                    @endforeach

                </div>
            </select>

        </div>

        <br>

        <input class="form-control" id="myInput" type="text" placeholder="Search.."> <br>
        <div class="table-responsive" id="table">

        </div>

        <div class="table-responsive" id="table" style="text-decoration: none">
            {{--<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead align="center">
                <th>No</th>
                <th>Student Name</th>
                <th>Quest Title</th>
                <th>Subject</th>
                <th>Ongoing</th>
                <th>Action</th>
                <?php $no = 1; ?>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$post->name}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->subject_name}}</td>


                        @if($post->ongoing == 0)
                            <td align="center"><img src="{{asset('../img/complete-stamp.png')}}" width="100px"></td>
                        @elseif($post->ongoing == 1)
                            <td align="center"><img src="{{asset('../img/ongoing-stamp.png')}}" width="100px"></td>
                        @elseif($post->ongoing == 2)
                            <td align="center"><img src="{{asset('../img/abort-stamp.png')}}" width="100px"></td>
                        @elseif($post->ongoing == 3)
                            <td align="center"><img src="{{asset('../img/failed-stamp.png')}}" width="100px"></td>
                        @endif
                        <td align="center">
                            @if($post->ongoing == 1)
                                <a href="{{route('postgrade', $post->id)}}">
                                    <button class="btn btn-primary">Grade</button>
                                </a>
                            @else
                                <button class="btn btn-primary" disabled>Grade</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>--}}
        </div>
    </div>
@endsection

<script type="text/javascript">
    function selectSubject(subject) {
        var subject = document.getElementById("subjects").value;
        var no = 1;
        var txt = "";
        var postid;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{url('selectSubjectInPost')}}',
            type: 'POST',
            data: {
                subjectName: subject,
            },
            success: function (data) {
                //JSON.parse(data);
                /*<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">*/
                txt += "<table class='table table-bordered id='dataTable' width='100%' cellspacing='0'>"
                txt += "<th> No </th> <th>Nama</th> <th>Quest</th> <th>Action</th>"
                txt += "<tbody id='myTable'>"
                for (i in data.subjects) {
                    txt += "<tr><td>" + no++ + "</td>" + "<td><a href='detailuser/" + data.subjects[i].id_user + "' style='color: black; text-decoration: none'>" +
                        data.subjects[i].name + "</a></td>" + "<td>" + data.subjects[i].title + "</td>" +
                        "<td><a href='postgrade/" + data.subjects[i].id + "'><button class=\"btn btn-primary\">Grade</button></a></td></tr>"
                }
                txt += '</tbody>'
                txt += "</table>"
                document.getElementById("table").innerHTML = txt;
                console.log(data)
                //alert('success').html(data);

                //Searching bar
                $(document).ready(function () {
                    $("#myInput").on("keyup", function () {
                        var value = $(this).val().toLowerCase();
                        $("#myTable tr").filter(function () {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });
                });
            },
            error: function (response) {
                //console.log(subject)
                console.log(response)
                //console.log(data)
                //document.getElementById("response").innerHTML = data.subjectName
            }


        });
    }


</script>
