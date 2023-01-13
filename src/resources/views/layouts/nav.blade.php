<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand"
            href="{{ route('articles.index') }}">SoundHub</a>
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
                <li class="nav-item">
                    <form class="input-group w-auto">
                        <input type="search"
                            class="form-control"
                            placeholder="検索..."
                            aria-label="Search" />
                        <button class="input-group-text border-0" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i> 投稿する</a>
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
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="navbarDropdown">
                            <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
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
                    <li class="nav-item mt-2"><a class="nav-link" href="{{ route("users.show", ["name" => Auth::user()->name])}}"><i class="fas fa-user mr-1"></i>マイページ</a></li>
                    <li class="nav-item mt-2">
                        <a class="nav-link" href="{{ route('logout') }}"onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt mr-1"></i>ログアウト</a>
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
