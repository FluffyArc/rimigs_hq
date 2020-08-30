@section('navclient')
    <div id="header">
        <div id="btn-menu" onclick="openNav()">
            <img src="{{ asset('img/navbutton.png') }}" style="width:80px; height: 121px">
        </div>
        <div id="navmenu">
            <div class="content">
                <img src="{{ asset('img/logo.png') }}" class="logo">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <hr class="white">
                <a href="#">Profile</a>
                <hr class="white">
                <a href="{{route('questLevel')}}">Quests</a>
                <hr class="white">
                <a href="#">Quest Taken</a>
                <hr class="white">
                <a href="{{ route('logout') }}">Sign Out</a>
                <hr class="white">
                <a href="{{route('clientLogin')}}">Sign In</a>
                <hr class="white">
            </div>
        </div>
        <script>
            function openNav() {
                var y = document.getElementById("btn-menu");
                y.style.display = "none"
                var x = document.getElementById("navmenu");
                x.style.display = "block";
                var z = document.getElementById("board");
                z.style.display = "none"
            }

            function closeNav() {
                var x = document.getElementById("btn-menu");
                var y = document.getElementById("navmenu");
                x.style.display = "block"
                y.style.display = "none"
                var z = document.getElementById("board");
                z.style.display = "block"
            }

        </script>
@endsection
