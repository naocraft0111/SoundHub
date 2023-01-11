@extends('layouts.app')

@section('title', 'タグ別一覧 | SoundHub')

@section('content')
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <h2 class="card-title m-0">{{ $tag->hashtag }}</h4>
                <div class="card-text text-end">
                    {{ $tag->articles->count() }}件
                </div>
            </div>
        </div>
        @foreach ($tag->articles as $article)
            @include('articles.card')
        @endforeach
    </div>
@endsection
