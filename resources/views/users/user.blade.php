@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Students List</h1>
        <div class="dropdown">
            <select class="btn btn-secondary dropdown-toggle" onchange="selectSubject()" id="subjects">
                <option value="" disabled selected>-Select Subjects-</option> <br>

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
    </div>
@endsection


<script type="text/javascript">
    function selectSubject(subject) {
        var subject = document.getElementById("subjects").value;
        var no = 1;
        var txt = "";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{url('selectSubject')}}',
            type: 'POST',
            data: {
                subjectName: subject
            },
            success: function (data) {
                //JSON.parse(data);
                /*<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">*/
                txt += "<table class='table table-bordered id='dataTable' width='100%' cellspacing='0'>"
                txt += "<th> No </th> <th>Nama</th> <th>Hunter Rank</th>"
                txt += "<tbody id='myTable'>"
                for(i in data.subjects){
                    txt+="<tr><td>"+no++ +"</td>"+"<td>"+data.subjects[i].name+"</td>"+"<td>"+data.subjects[i].hr+"</td></tr>"
                }
                txt+='</tbody>'
                txt+="</table>"
                document.getElementById("table").innerHTML = txt;
                console.log(data)
                //alert('success').html(data);

                //Searching bar
                $(document).ready(function(){
                    $("#myInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#myTable tr").filter(function() {
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
