@extends('base')
@extends('client.navclient')
@section('content')
<center>
	<div class="login">
		<img src="{{ asset('img/Dragons.png') }}" style="width: 70%">
		<form>
  			<div class="form-group">
    			<label for="StudentID"><h2>Student ID</h2></label><p>    			
    			<input type="text" class="form-control" id="StudentID" placeholder="Insert your student ID">
    			</p>

  			</div>
  			<div class="form-group">
    			<label for="Password"><h2>Password</h2></label><p>
    			<input type="password" class="form-control" id="Password" placeholder="Password">
    		</p>
  			</div>

  			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</center>
@endsection