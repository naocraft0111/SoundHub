@extends('layouts.app')

@section('title', $user->name. 'いいねした記事')

@section('content')
    <div class="container">
        @include('users.user')
        @include('users.tabs', ['hasDetails' => false, 'hasArticles' => false, 'hasLikes' => true])
        @foreach ($articles as $article)
            @include('articles.card')
        @endforeach
        @include('articles.pagination')
    </div>
@endsection
