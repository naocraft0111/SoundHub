@extends('layouts.app')

@section('title', 'プロフィール編集画面 | SoundHub')

@section('content')
<div class="container">
    @include('users.user')
    @include('users.tabs', ['hasDetails' => true, 'hasArticles' => false, 'hasLikes' => false])
    <div class="card mt-3">
        <div class="card-body">
            <div class="text-center">
                @if(isset($user->prof_video_path))
                    <iframe width="390" height="263.125" src="{{ 'https://www.youtube.com/embed/'.$user->prof_video_path }}?controls=1&loop=1&playlist={{ $user->prof_video_path }}" frameborder="0" allowfullscreen></iframe>
                @endif
            </div>
            <div class="mt-3">
                @if(isset($user->self_introduction))
                <label>自己紹介</label>
                <p>{{ $user->self_introduction }}</p>
                @endif
            </div>
            <div class="mt-3">
                @if(isset($user->age))
                <label>年齢</label>
                <p>{{ $user->age }}歳</p>
                @endif
            </div>
            <div class="mt-3">
                @if(isset($user->genderName))
                <label>性別</label>
                <p>{{ $user->genderName }}</p>
                @endif
            </div>
            <div class="mt-3">
                @if(isset($user->prefName))
                <label>所在地</label>
                <p>{{ $user->prefName }}</p>
                @endif
            </div>
            <div class="mt-3">
                @if(isset($user->prefName))
                <label>楽器経験</label>
                <p>{{ $user->instrumentYearsName }}</p>
                @endif
            </div>
        </div>
</div>
@endsection
