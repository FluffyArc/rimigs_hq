@extends('base')
@extends('client.navclient')
@section('content')
<center>
<div class="col-md-12" id="board" >
	<img src="{{ asset('img/board.png') }}" class="board-img">
	<div id="board-content" >
		<div class="text" style="background-image: url('img/paper.png');">
			<p>FSI 201</p>
		</div>
        <div class="text" style="background-image: url('img/paper.png');">
            <p>FSI 201</p>
        </div>
        <div class="text" style="background-image: url('img/paper.png');">
            <p>FSI 201</p>
        </div><div class="text" style="background-image: url('img/paper.png');">
            <p>FSI 201</p>
        </div>

	</div>
</div>

</center>
@endsection
