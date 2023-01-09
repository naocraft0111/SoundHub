@extends('layouts.app')

@section('title', '記事一覧')

@section('content')
    <div class="container">
        @foreach($articles as $article)
            @include('articles.card')
        @endforeach
    </div>
@endsection
