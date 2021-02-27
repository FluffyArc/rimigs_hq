@extends('base')
@extends('client.navclient')
@section('content')
    <center>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <div class="login">
            <img src="{{ asset('img/change-pass-header.png') }}" style="width: 100%">
            <form method="POST" action="{{route('changepass')}}">
                @csrf
                <div class="form-group">
                    <label for="email" class="label"><h4>Email</h4></label>
                    <input id="email" type="text" class="form-control" name="email" required placeholder="Username"
                           autofocus>
                </div>
                <div class="form-group">
                    <label for="new-password" class="label"><h4>New Password</h4></label>
                    <input id="new-password" type="password" class="form-control" name="new-password" required
                           placeholder="New Password" autofocus>
                </div>
                <div class="form-group">
                    <label for="confirm-password" class="label"><h4>Confirm Password</h4></label>
                    <input id="confirm-password" type="password" class="form-control" name="confirm-password" required
                           placeholder="Confirm Password" autofocus>
                </div>
                <input type="image" name="submit" src="../img/change-pass-button.png" class="change-pass-button" onclick="changePass()">

            </form>

        </div>
        <script>
            function changePass() {
                var email = document.getElementById('email').value;
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
                        email: email,
                        newpass: newPass,
                        confirmpass: confirmPass,
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
