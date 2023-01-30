<div class="card mt-3">
    <div class="card-body">
        <div class="d-flex flex-row">
            <a href="{{ route('users.detail', ['name' => $person->name])}}" class="text-dark">
                @if (empty($person->avatar))
                <img src="{{ asset('images/user_default.png') }}" id="img" class="img-fuild rounded-circle" style="object-fit: cover;" width="50" height="50">
                @else
                <img src="{{ asset('storage/avatar/' . $person->avatar) }}" id="img" class="img-fuild rounded-circle" style="object-fit: cover;" width="50" height="50">
                @endif
            </a>
            @if (Auth::id() !== $person->id)
                <follow-button class="ms-auto"
                    :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
                    :authorized='@json(Auth::check())'
                    endpoint="{{ route('users.follow', ['name' => $person->name]) }}">
                </follow-button>
            @endif
        </div>
        <h2 class="card-title m-0">
            <a href="{{ route('users.detail', ['name' => $person->name])}}" class="text-dark">
            {{ $person->name }}
            </a>
        </h2>
    </div>
</div>
