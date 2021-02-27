@section('sidenav')
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                @if(Auth::check() && Auth::user()->user_type == 'teacher')
                    <a class="nav-link" href="{{route('home')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <a class="nav-link" href="{{route('questForm')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-edit"></i>
                        </div>
                        Add Quest
                    </a>

                    <a class="nav-link" href="{{route('userForm')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-edit"></i>
                        </div>
                        Add Player
                    </a>

                    <a class="nav-link" href="{{route('subjectList')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i>
                        </div>
                        All Quest
                    </a>



                    <a class="nav-link" href="{{route('users')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i>
                        </div>
                        All Player
                    </a>


                    <a class="nav-link" href="{{route('posts')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Posts
                    </a>
                    <a class="nav-link" href="{{route('adminSubjects')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Subject
                    </a>
                    <a class="nav-link" href="{{route('achievement')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Achievement
                    </a>
                    <a class="nav-link" href="{{route('lectures')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Lectures
                    </a>


                @elseif(Auth::check() && Auth::user()->user_type == 'assistant')

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Quest
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                         data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('questForm')}}">Add Quest</a>
                            <a class="nav-link" href="{{route('showQuest')}}">All Quest</a>
                        </nav>
                    </div>


                    <a class="nav-link" href="{{route('posts')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Posts
                    </a>

                @endif
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Administrator
        </div>
    </nav>
@endsection

