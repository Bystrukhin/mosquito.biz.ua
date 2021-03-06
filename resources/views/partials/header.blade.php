<header id="header">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="header_bottom">
                <div class="logo_area"><a href="{{ route('home.index') }}" class="logo"><img src="{{ asset('images/logo.jpg') }}" alt=""></a></div>
                <div class="add_banner"><a href="#"><img src="images/addbanner_728x90_V1.jpg" alt=""></a></div>
            </div>
        </div>

    </div>
    <section id="navArea">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav main_nav">
                    @foreach($top_menu as $top_item)
                        @if($top_item->name == 'Home')
                        <li class="active">
                            <a href="{{ url($top_item->url) }}">
                                <span class="fa fa-home desktop-home"></span>
                                <span class="mobile-show">{{$top_item->name}}</span>
                            </a>
                        </li>
                        @elseif($top_item->child == 1)
                                <li class="dropdown-submenu"> <a class="dropdown-toggle dropdown-item" data-toggle="dropdown" href="#" >{{$top_item->name}}</a>
                                    <ul class="nav navbar-nav dropdown-menu" role="menu">
                                        @foreach($mid_menu as $mid_item)
                                            @if($mid_item->top_id == $top_item->id)
                                            @if($mid_item->child == 0)
                                        <li>
                                            <a class="dropdown-item" href="{{ url($top_item->url.'/'.$mid_item->url) }}">{{$mid_item->name}}</a>
                                        </li>
                                            @elseif($mid_item->child == 1)
                                        <li  class="dropdown-submenu">
                                            <a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown">{{$mid_item->name}}</a>
                                            <ul class="nav navbar-nav dropdown-menu" role="menu">
                                                @foreach($bot_menu as $bot_item)
                                                    @if($bot_item->top_id == $top_item->id)
                                                    @if($bot_item->mid_id == $mid_item->id)
                                                    <li>
                                                        <a href="{{ url($top_item->url.'/'.$bot_item->url) }}">{{$bot_item->name}}</a>
                                                    </li>
                                                    @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                            @endif
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                        @elseif($top_item->child == 0)
                                <li><a href="{{ url($top_item->url) }}">{{$top_item->name}}</a></li>
                        @endif

                    @endforeach
                        @if(Auth::check())
                        @if(Auth::user()->isAdmin())
                        <div class="navbar-header">
                            <a href="{{ route('user.admin') }}" class="navbar-brand"><b>Admin</b></a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                        @endif
                        @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> User Management <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @if(Auth::check())
                                <li><a href="{{ route('user.profile') }}">User Profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('user.logout') }}">Logout</a></li>
                            @else
                                <li><a href="{{ route('user.signup') }}">Signup</a></li>
                                <li><a href="{{ route('user.signin') }}">Signin</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
                <form class="nav navbar-nav navbar-right" action="{{route('tag.search')}}">
                        <input class="search_input" placeholder="Enter your search tag..." type="text" list="tags_results" name="search" id="search" onkeydown="down()" onkeyup="up()">
                        <button class="default-btn" type="submit">Search</button>
                </form>
                <datalist class="search_results" id="tags_results"></datalist>
                <script>
                    var timer;

                    function down() {
                        clearTimeout(timer);
                    }

                    function up () {
                        timer = setTimeout(function () {
                            var keywords = $('#search').val();

                            if(keywords.length > 0) {
                                $.get('{{ asset('execute_search') }}', {keywords: keywords}, function (markup) {
                                    $('#tags_results').html(markup);
                                })
                            }
                        }, 500);
                    }
                </script>
            </div>

        </nav>
    </section>
</header>
