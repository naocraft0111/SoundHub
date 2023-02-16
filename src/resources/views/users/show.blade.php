@extends('layouts.app')

@section('title', $user->name. ' | SoundHub')

@section('content')
    <div class="container">
        @include('error_card_list')
        @include('users.user')
        @include('users.tabs', ['hasDetails' => false, 'hasArticles' => true, 'hasLikes' => false])
        @foreach ($articles as $article)
            @include('articles.card')
        @endforeach
        @include('articles.pagination')
        @include('new_post_button')
    </div>
@endsection
