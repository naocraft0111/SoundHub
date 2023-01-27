@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="container">
        @include('error_card_list')
        @include('users.user')
        @include('users.tabs', ['hasDetails' => false, 'hasArticles' => true, 'hasLikes' => false])
        @foreach ($articles as $article)
            @include('articles.card')
        @endforeach
        @include('users.pagination')
    </div>
@endsection
