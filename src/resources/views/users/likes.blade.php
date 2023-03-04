@extends('layouts.app')

@section('title', $user->name. 'さんがいいねした記事 | SoundHub')

@section('content')
    <div class="container">
        @include('users.user')
        @include('users.tabs', ['hasDetails' => false, 'hasArticles' => false, 'hasLikes' => true])
        @foreach ($articles as $article)
            @include('articles.card')
        @endforeach
        @include('articles.pagination')
        @include('new_post_button')
    </div>
@endsection
