@extends('layouts.app')

@section('title', '記事一覧')

@section('content')
<div class="container">
    <div class="scroll">
        @include('error_card_list')
        <div id="post-data">
            @foreach($articles as $article)
            @include('articles.card')
            @endforeach
        </div>
    </div>
    @if ($articles->hasMorePages())
    <p class="button more"><a href="{{ $articles->links() }}"></a></p>
    @endif

    {{-- <div class="ajax-load text-center" style="display:none">
        <p><img src="{{ asset('images/loader.gif') }}"> Loading More Post</p>
    </div> --}}
@endsection
