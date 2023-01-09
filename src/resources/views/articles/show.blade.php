@extends('layouts.app')

@section('title', '記事詳細')

@section('content')
    <div class="container">
        @include('articles.card')
    </div>
@endsection
