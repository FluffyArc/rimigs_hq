@extends('base')
@extends('client.navclient')
@section('content')
<center>
<div class="col-md-12" id="board" >
	<img src="{{ asset('img/questpage.png') }}" >	
	<div id="quest-content">
		<img src="{{ asset('img/Dragons.png') }}" style="padding-top: 150px;">
	</div>
	<div id="quest-detail">
	<p><h1 style="text-align: center; padding-left: 30px; ">Choose an option</h1></p>
		<div class="button" style="background-image: url('img/button.png');">
			<h2>Take A Quest</h2>
		</div>
		<div class="button" style="background-image: url('img/button.png');">
			<h2>Taken Quest</h2>
		</div>		
	</div>

</div>

</center>
@endsection