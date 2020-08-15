<header>
    <div class="container-fluid position-relative no-side-padding">

        <a href="#" class="logo"><img src="{{asset('public/assets/frontend')}}/images/logo.png" alt="Logo Image"></a>

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{route('homepage')}}">Home</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="{{route('post.all')}}">posts</a></li>
            <li>
                @guest
                    <a href="{{route('login')}}">Login</a>
                @else
                    @if(Auth::user()->id ==1)
                        <a href="{{route('admin.dashboard')}}" target="_blank">Dashboard</a>
                    @else
                        <a href="{{route('author.dashboard')}}" target="_blank">Dashboard</a>
                    @endif

                @endguest


            </li>

        </ul><!-- main-menu -->

        <div class="src-area">
            <form method="GET" action="{{route('post.search')}}">
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input class="src-input" value="{{isset($query)? $query:''}}" type="text" placeholder="Type of search" name="query">
            </form>
        </div>

    </div><!-- conatiner -->
</header>
