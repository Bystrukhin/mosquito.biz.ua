<header id="header">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="header_bottom">
                <div class="logo_area"><a href="{{ route('home.index') }}" class="logo"><img src="/mosquito/public/images/logo.jpg" alt=""></a></div>
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
                            <a href="{{ route('home.index') }}">
                                <span class="fa fa-home desktop-home"></span>
                                <span class="mobile-show">{{$top_item->name}}</span>
                            </a>
                        </li>
                        @elseif($top_item->name == 'Categories')
                                <li class="dropdown-submenu"> <a class="dropdown-toggle dropdown-item" data-toggle="dropdown" href="#" >{{$top_item->name}}</a>
                                    <ul class="nav navbar-nav dropdown-menu" role="menu">
                                        @foreach($mid_menu as $mid_item)
                                            @if($mid_item->name !== 'Lifestyle')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('category.index', ['category_id' => $mid_item->url]) }}">{{$mid_item->name}}</a>
                                        </li>
                                            @elseif($mid_item->name == 'Lifestyle')
                                        <li  class="dropdown-submenu">
                                            <a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown">{{$mid_item->name}}</a>
                                            <ul class="nav navbar-nav dropdown-menu" role="menu">
                                                @foreach($bot_menu as $bot_item)
                                                    <li>
                                                        <a href="{{ route('category.index', ['category_id' => $bot_item->url]) }}">{{$bot_item->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                        @elseif($top_item->name == 'Contacts')
                                <li><a href="{{ route('home.getContacts') }}">{{$top_item->name}}</a></li>
                        @elseif($top_item->name == 'About us')
                            <li><a href="{{ route('home.getAbout') }}">{{$top_item->name}}</a></li>
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
                        <input class="search_input" placeholder="Enter your search tag..." type="text" name="search" id="search" onkeydown="down()" onkeyup="up()">
                        <button class="default-btn" type="submit">Search</button>
                </form>

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
                                    $('#search-results').html(markup);
                                })
                            }
                        }, 500);
                    }
                </script>
            </div>

        </nav>
    </section>
    <div class="search_results" id="search-results"></div>
</header>
