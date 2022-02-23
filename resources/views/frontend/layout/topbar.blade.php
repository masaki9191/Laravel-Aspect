<header>
    <div id="header">
        <h1><a href="/"><img src="{{asset('assets/frontend/images/logo.png')}}" alt="APEST 投資家と共に歩む"></a></h1>
        <div class="menu-trigger">
            <div>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        @if(Auth::check())
        <nav>
            <ul>
                <li><a href="/logout">ログアウト</a></li>
            </ul>
        </nav>
        <form id="logout-form" action="{{ route('frontend.auth.logout') }}" method="POST" style="display: none">
            @csrf
        </form>
        @endif
    </div>
</header>