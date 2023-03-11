<div class="card mt-3">
    <div class="card-body">
        <div class="d-flex flex-row align-items-center">
            @if (empty($user->avatar))
                <a href="{{asset('images/user_default.png') }}" class="gallery">
                    <img src="{{asset('images/user_default.png') }}" id="img" class="img-fuild rounded-circle" style="object-fit: cover;" width="50" height="50">
                </a>
            @else
                <a href="{{ $user->avatar }}" class="gallery">
                    <img src="{{ $user->avatar }}" id="img" class="img-fuild rounded-circle" style="object-fit: cover;" width="50" height="50">
                </a>
            @endif
            @if (Auth::id() !== $user->id)
                <div class="ms-auto d-inline-flex align-items-center">
                    <livewire:chat.create-chat :user="$user">
                    <follow-button
                        :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                        :authorized='@json(Auth::check())'
                        endpoint="{{ route('users.follow', ['name' => $user->name]) }}">
                    </follow-button>
                </div>
            @else
                <a href="{{ route('users.edit', ['name' => $user->name]) }}" class="btn btn-light border text-dark fw-bold ms-auto text-center text-decoraiton-none a_btn" role="button">プロフィール編集</a>
            @endif
        </div>
        <h2 class="card-title m-0">
            <a href="{{ route('users.detail', ['name' => $user->name])}}" class="text-dark">
            {{ $user->name }}
            </a>
        </h2>
    </div>
    <div class="card-body">
        <div class="card-text">
            <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
                {{ $user->count_followings }}フォロー
            </a>
            <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
                {{ $user->count_followers }}フォロワー
            </a>
        </div>
    </div>
</div>
