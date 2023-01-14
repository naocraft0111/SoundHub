@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="container">
        @include('error_card_list')
        @include('users.user')
        @include('users.tabs', ['hasArticles' => true, 'hasLikes' => false])
        @foreach ($articles as $article)
            @include('articles.card')
        @endforeach
    </div>
@endsection
