@extends('layouts.app')

@section('title', $user->name. 'さんのプロフィール | SoundHub')

@section('content')
<div class="container">
    @include('users.user')
    @include('users.tabs', ['hasDetails' => true, 'hasArticles' => false, 'hasLikes' => false])
    <div class="card mt-3">
        <div class="card-body">

            @if(isset($user->prof_video_path))
            <h4 class="fw-bold border-bottom">アピール動画</h4>
            <div class="video m-auto">
                <div class="ratio ratio-16x9">
                    <iframe width="390" height="263.125" src="{{ 'https://www.youtube.com/embed/'.$user->prof_video_path }}?controls=1&loop=1&playlist={{ $user->prof_video_path }}" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            @endif

            @if(isset($user->self_introduction))
            <div class="mt-3">
                <h4 class="fw-bold border-bottom">自己紹介</h4>
                <p>{!! nl2br(e($user->self_introduction)) !!}</p>
            </div>
            @endif

            @if(isset($user->age))
            <div class="mt-3">
                <h4 class="fw-bold border-bottom">年齢</h4>
                <p>{{ $user->age }}歳</p>
            </div>
            @endif

            @if(isset($user->gender_id))
            <div class="mt-3">
                <h4 class="fw-bold border-bottom">性別</h4>
                <p>{{ $user->genderName }}</p>
            </div>
            @endif

            @if(isset($user->prefName))
            <div class="mt-3">
                <h4 class="fw-bold border-bottom">所在地</h4>
                <p>{{ $user->prefName }}</p>
            </div>
            @endif

            @if($user->user_secondaryCategories->isEmpty())
            @else
            <div class="mt-3">
                <h4 class="fw-bold border-bottom">楽器名</h4>
                <div class="row">
                    @foreach ($user->user_secondaryCategories as $instrument_name)
                        <p class="col-auto mb-0">{{ $instrument_name->name }}</p>
                    @endforeach
                </div>
            </div>
            @endif

            @if($user->user_soundCategories->isEmpty())
            @else
                <div class="mt-3">
                    <h4 class="fw-bold border-bottom">音楽性</h4>
                    <div class="row">
                        @foreach ($user->user_soundCategories as $soundCategory)
                            <p class="col-auto">{{ $soundCategory->name }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
