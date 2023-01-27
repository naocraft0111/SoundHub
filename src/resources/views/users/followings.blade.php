@extends('layouts.app')

@section('title', $user->name. 'のフォロー中')

@section('content')
    <div class="container">
        @include('users.user')
        @include('users.tabs', ['hasDetails' => true, 'hasArticles' => false, 'hasLikes' => false])
        @foreach ($followings as $person)
            @include('users.person')
        @endforeach
        {{ $followings->links('pagination::default') }}
    </div>
@endsection
