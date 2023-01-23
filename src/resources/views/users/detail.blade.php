@extends('layouts.app')

@section('title', 'プロフィール編集画面 | SoundHub')

@section('content')
<div class="container">
    @include('users.user')
    @include('users.tabs', ['hasDetails' => true, 'hasArticles' => false, 'hasLikes' => false])
    <div class="card mt-3">
        <div class="card-body">

            @if(isset($user->prof_video_path))
            <div class="text-center">
                    <iframe width="390" height="263.125" src="{{ 'https://www.youtube.com/embed/'.$user->prof_video_path }}?controls=1&loop=1&playlist={{ $user->prof_video_path }}" frameborder="0" allowfullscreen></iframe>
                </div>
            @endif

            @if(isset($user->self_introduction))
            <div class="mt-3">
                <label>自己紹介</label>
                <p>{{ $user->self_introduction }}</p>
            </div>
            @endif

            @if(isset($user->age))
            <div class="mt-3">
                <label>年齢</label>
                <p>{{ $user->age }}歳</p>
            </div>
            @endif

            @if($user->gender_id == 3)
            @elseif(!empty($user->gender_id))
            <div class="mt-3">
                <label>性別</label>
                <p>{{ $user->genderName }}</p>
            </div>
            @endif

            @if(isset($user->prefName))
            <div class="mt-3">
                <label>所在地</label>
                <p>{{ $user->prefName }}</p>
            </div>
            @endif

            @if($user->user_secondaryCategories->isEmpty())
            @else
            <div class="mt-3">
                <label>楽器名</label>
                <div class="row">
                    @foreach ($user->user_secondaryCategories as $instrument_name)
                        <p class="col-auto">{{ $instrument_name->name }}</p>
                    @endforeach
                </div>
            </div>
            @endif

            @if($user->user_soundCategories->isEmpty())
            @else
                <div class="mt-3">
                    <label>音楽性</label>
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
