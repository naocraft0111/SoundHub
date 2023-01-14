@extends('layouts.app')

@section('title', '記事詳細')

@section('content')
    <div class="container">
        @include('error_card_list')
        @include('articles.card')
        @include('comments.card')
    </div>
@endsection
