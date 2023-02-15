@extends('layouts.app')

@section('title', '記事一覧 | SoundHub')

@section('content')
<div class="container">
    @include('error_card_list')
    @if (count($articles) > 0)
        @foreach($articles as $article)
            @include('articles.card')
        @endforeach
    @else
        <div class="fs-4 text-center text-primary mt-5">
            一致する結果はありませんでした。
        </div>
    @endif
    @include('articles.pagination')
@endsection
