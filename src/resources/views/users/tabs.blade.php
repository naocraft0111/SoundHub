<ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
        <a class="nav-link text-muted px-1 {{ $hasDetails ? 'active' : ''}}"
            href="{{ route('users.detail', ['name' => $user->name]) }}">
            プロフィール詳細
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{ $hasArticles ? 'active' : '' }}"
            href="{{ route('users.show', ['name' => $user->name]) }}">
            記事
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{ $hasLikes ? 'active' : '' }}"
            href="{{ route('users.likes', ['name' => $user->name]) }}">
            いいね
        </a>
    </li>
</ul>
