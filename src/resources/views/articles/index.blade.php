@extends('layouts.app')

@section('title', '記事一覧')

@section('content')
<div class="container">
    @include('error_card_list')
    @foreach($articles as $article)
    @include('articles.card')
    @endforeach
    @include('articles.pagination')
@endsection
