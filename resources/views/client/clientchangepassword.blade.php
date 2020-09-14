@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <div class="col-md-12" id="board">
            <img src="{{ asset('img/questpage-2.png') }}" class="questPageImage-2">
            <div class="col-md-12">
                <img src="{{asset('../img/change-pass-header.png')}}" class="profile-header">
            </div>
            <div class="col-md-12 custom-scrollbar-css">
                <form class="change-form">
                    @csrf
                    <div class="form-group change-input">
                        <label for="password" class="label">Current Password</label>
                        <input type="password" id="current-password" name="current-password" placeholder="Current Password">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <br>
                    <div class="form-group change-input">
                        <label for="password" class="label">New Password</label>
                        <input type="password" id="new-password" name="new-password" placeholder="New Password">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <br>
                    <div class="form-group change-input">
                        <label for="password" class="label">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <br>
                    <div class="form-group change-input">
                        <img src="{{asset('../img/change-pass-button.png')}}" onclick="changePass()">

                    </div>


                </form>

            </div>
        </div>

        <script>
            function changePass() {
                var currPass = document.getElementById('current-password').value;
                var newPass = document.getElementById("new-password").value;
                var confirmPass = document.getElementById('confirm-password').value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{url('changepass')}}',
                    type: 'POST',
                    data: {
                        id: {{Auth::user()->id}},
                        currpass: currPass,
                        newpass: newPass,
                        confirmpass: confirmPass,
                    },
                    success: function (data) {
                        if(data.failed){
                            swal(data.failed, {
                                icon: "error",
                            });
                        }else if(data.success){
                            swal(data.success, {
                                icon: "success",
                            });

                            setTimeout(function () {
                                window.location.href = "{{route('subjects')}}";
                            }, 3000);
                        }
                        //alert('success').html(data);
                    },
                    error: function (response) {
                        console.log(data)
                    }


                });
                //document.getElementById('questDetail').innerHTML =


            }
        </script>

    </center>
@endsection
