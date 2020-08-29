@extends('base')
@extends('client.navclient')
@section('content')
<center>
	<link rel = "stylesheet" href= "{{asset('css/bootstrap.min.css')}}">
	<div class="login">
		<img src="{{ asset('img/Dragons.png') }}" style="width: 70%">
		<form>
  			<div class="form-group">
    			<label for="StudentName" class="label"><h4>Name</h4></label><p>    			
    			<input type="text" class="form-control" id="StudentName" placeholder="Insert your Name">
    			</p>

  			</div>
        <div class="form-group">
          <label for="StudentEmail" class="label"><h4>Email</h4></label><p>         
          <input type="Email" class="form-control" id="StudentEmail" placeholder="Insert your Email">
          </p>

        </div>
  			<div class="form-group">
    			<label for="Password" class="label"><h4>Password</h4></label><p>
    			<input type="password" class="form-control" id="Password" placeholder="Password">
    		</p>
  			</div>
        <div class="form-group">
          <label for="ConfirmPassword" class="label"><h4>Confirm Password</h4></label><p>
          <input type="password" class="form-control" id="ConfirmPassword" placeholder="ConfirmPassword">
        </p>
        </div>
  			<a href="#">
          <img src="{{ asset('img/eggsclosed.png') }}" id="eggclosed" onmouseover="openegg()" class="mt-3">
          <img src="{{ asset('img/egg.png') }}" id="eggopen" onmouseout="closeegg()" class="mt-3" style="display: none;">   
        </a>
		</form>
	</div>
</center>

<script>
function openegg() {
  var y = document.getElementById("eggclosed");
  y.style.display = "none"
  var x = document.getElementById("eggopen");
  x.style.display = "block";

}

function closeegg() {
  var y = document.getElementById("eggclosed");
  y.style.display = "block"
  var x = document.getElementById("eggopen");
  x.style.display = "none";
}
</script>
@endsection