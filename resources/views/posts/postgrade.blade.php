@extends('layouts.topnav')
@extends('layouts.sidenav')

@section('content')
    <div class="card-body">
        <h1>Grade</h1>
        <form>

            <div class="form-group">
                <label>Student Name</label>
                <input type="text" class="form-control" id="studentName" name="studentName" value="{{$post->name}}"
                       readonly>
            </div>
            <div class="form-group">
                <label>Quest Title</label>
                <input type="text" class="form-control" id="questTitle" name="questTitle" value="{{$post->title}}"
                       readonly>
            </div>
            <div class="form-group">
                <label>Quest Description</label>
                <textarea class="form-control" id="questDesc" name="questDesc" readonly>{{$post->desc}}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Expired Date</label>
                    <input type="text" class="form-control" id="expDate" name="expDate"
                           value="{{date('d-M-Y', strtotime($post->exp_date)) }}" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label>Complete Date</label>
                    <input type="text" class="form-control" id="completeDate" name="completeDate"
                           value="{{$date}}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label>Subject</label>
                <input type="text" class="form-control" id="subject" name="subject"
                       value="{{$post->subject_name}}" readonly>
            </div>
            <div class="form-row">
                <div class="form-group col-md-1">
                    <label>Max Grade</label>
                    <input type="text" class="form-control" id="maxgrade" name="maxgrade" value="{{$post->exp}}"
                           readonly>

                </div>
                <div class="form-group col-md-1">
                    <label>Grade</label>
                    <input type="text" class="form-control" id="grade" name="grade">

                </div>


            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-1 pt-0">Status</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status"
                                   value="0" checked>
                            <label class="form-check-label" for="status">
                                Complete
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status"
                                   value="3">
                            <label class="form-check-label" for="status">
                                Failed
                            </label>
                        </div>

                    </div>
                </div>
            </fieldset>
            <button type="button" class="btn btn-primary" onclick="postgrade({{$post->id}})">Submit</button>
        </form>
    </div>


    <script>
        function postgrade(idpost) {
            var studentName = document.getElementById('studentName').value;
            var grade = document.getElementById('grade').value;
            var completeDate = document.getElementById('completeDate').value;
            var maxgrade = document.getElementById('maxgrade').value;
            var status = document.getElementsByName('status');
            var stat;

            for (var i=0;i<status.length;i++ ){
                if(status[i].checked)
                    stat = status[i].value;
            }

            swal({
                title: "Grade This Quest?",
                text: "Graded Quest cannot be change",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '{{url('grade')}}',
                            type: 'POST',
                            data: {
                                id: idpost,
                                name: studentName,
                                completeDate: completeDate,
                                maxgrade: maxgrade,
                                status: stat,
                                grade: grade
                            },
                            success: function (data) {
                                if (data.failed) {
                                    swal(data.failed, {
                                        icon: "error",
                                    });

                                } else if (data.success) {
                                    swal(data.success, {
                                        icon: "success",
                                    });
                                }

                            },
                            error: function (response) {
                                console.log(response);
                            }


                        });

                    } else {
                        swal("Grade it when you ready :)");
                    }
                });



            //document.getElementById('questDetail').innerHTML =


        }

    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
