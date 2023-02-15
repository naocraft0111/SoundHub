@extends('layouts.app')

@section('title', $user->name. 'のフォロー中 | SoundHub')

@section('content')
    <div class="container">
        @include('users.user')
        @include('users.tabs', ['hasDetails' => false, 'hasArticles' => false, 'hasLikes' => false])
        @foreach ($followings as $person)
            @include('users.person')
        @endforeach
        <div class="pagination mt-3 justify-content-center">
            {{ $followings->links('pagination::default') }}
        </div>
    </div>
@endsection
