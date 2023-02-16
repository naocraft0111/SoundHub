<nav class="navbar navbar-expand-lg navbar-light nav_color">
    <div class="container">
        <h1 class="site-title">
            <a href="{{ route('articles.index') }}"><img src="{{ asset('images/logo.png') }}" alt="SoundHub"></a>
        </h1>
        {{-- ハンバーガーメニュー --}}
        <button class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse"
            id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto">
            @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login.guest') }}">ゲストログイン</a>
                    </li>
            @endguest

            @auth
                {{-- 検索フォーム --}}
                <form method="GET" action="{{ route('articles.search') }}" class="d-flex">
                    @csrf
                    <div class="input-group">
                        <input type="search"
                        name="search"
                        class="form-control d-none d-lg-block bg-white"
                        placeholder="記事検索..."
                        aria-label="Search" />
                        <div class="input-group-append">
                            <button class="input-group-text border-0 d-none d-lg-block bg-white" type="submit"><i class="fas fa-search icon_color"></i></button>
                        </div>
                    </div>
                </form>
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link notification" href="{{ route('chat') }}">
                        <i class="fa fa-envelope me-1">
                            @if($count !== 0)
                            <span class="notification-badge">{{ $count }}</span>
                            @endif
                        </i>
                        メッセージ</a>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link" href="{{ route('users.index') }}"><i class="fa fa-users me-1"></i>ユーザー一覧</a>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen me-1"></i>投稿する</a>
                </li>
                <div class="d-none d-lg-block">
                    {{-- ドロップダウンメニュー --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-mdb-toggle="dropdown"
                            aria-expanded="false">
                            @if (empty(Auth::user()->avatar))
                            <img src="{{asset('images/user_default.png') }}" id="img" class="rounded-circle" style="object-fit: cover;" height="22" alt="Avatar" loading="lazy" />
                            @else
                            <img src="{{ asset('storage/avatar/' . Auth::user()->avatar) }}" id="img" class="rounded-circle" style="object-fit: cover;" height="22" loading="lazy" />
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="navbarDropdown">
                            <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.detail", ["name" => Auth::user()->name]) }}'">
                                マイページ
                            </button>
                            <hr class="dropdown-divider" />
                            <button form="logout-button" class="dropdown-item" type="submit" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                ログアウト
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </div>

                {{-- sp --}}
                <div class="d-block d-lg-none">
                    <form method="GET" action="{{ route('articles.search') }}" class="d-flex mt-2">
                        @csrf
                        <div class="input-group">
                            <input type="search"
                            name="search"
                            class="form-control bg-white"
                            placeholder="記事検索..."
                            aria-label="Search" />
                            <div class="input-group-append">
                                <button class="input-group-text border-0 bg-white" type="submit"><i class="fas fa-search icon_color"></i></button>
                            </div>
                        </div>
                    </form>
                    <li class="nav-item">
                        <a class="nav-link notification" href="{{ route('chat') }}">
                            <i class="fa fa-envelope me-1">
                                @if($count !== 0)
                                <span class="notification-badge">{{ $count }}</span>
                                @endif
                            </i>
                            メッセージ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}"><i class="fa fa-users me-1"></i>ユーザー一覧</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen me-1"></i>投稿する</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("users.detail", ["name" => Auth::user()->name])}}"><i class="fas fa-user me-1"></i>マイページ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-1"></i>ログアウト</a>
                        <form name="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </li>
                </div>
            @endauth
            </ul>
        </div>
    </div>
</nav>
