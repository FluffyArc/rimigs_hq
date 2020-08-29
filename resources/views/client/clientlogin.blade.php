@extends('base')
@extends('client.navclient')
@section('content')
<center>
	<link rel = "stylesheet" href= "{{asset('css/bootstrap.min.css')}}">
	<div class="login">
		<img src="{{ asset('img/Dragons.png') }}" style="width: 70%">
		<form>
  			<div class="form-group">
    			<label for="StudentID" class="label"><h2>Student ID</h2></label><p>    			
    			<input type="text" class="form-control" id="StudentID" placeholder="Insert your student ID">
    			</p>

  			</div>
  			<div class="form-group">
    			<label for="Password" class="label"><h2>Password</h2></label><p>
    			<input type="password" class="form-control" id="Password" placeholder="Password">
    		</p>
  			</div>

  			<button type="submit" class="btn btn-primary mt-4">Submit</button>
		</form>
	</div>
</center>
@endsection