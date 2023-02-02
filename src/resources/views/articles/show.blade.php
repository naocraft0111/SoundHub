@extends('layouts.app')

@section('title', '記事詳細')

@section('content')
    <div class="container">
        <div class="container">
            {{ Breadcrumbs::render('articles.show', $article) }}
        </div>
        @include('error_card_list')
        @include('articles.card')
        @include('comments.card')
        @include('comments.pagination')
    </div>
@endsection
