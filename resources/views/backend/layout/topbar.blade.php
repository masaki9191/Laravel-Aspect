
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{asset('assets/img/black_logo.png')}}" alt="" class="logo">
        </a>

        @if(Auth::check())
        <a class="btn btn-primary d-block d-sm-none" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('ログアウト') }}</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('build.index')}}">ビルド管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('room.index')}}">所在階管理</a>
                </li>                
                <!-- Authentication Links -->
                <li class="nav-item">
                    <a class="nav-link" href=""
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('ログアウト') }}
                    </a>
                    <form id="logout-form" action="{{ route('backend.auth.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>
