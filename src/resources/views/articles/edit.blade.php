@extends('layouts.app')

@section('title', 'SoundHub | 投稿編集')
@section('content')
<div class="py-4">
    <div class="container"
        style="max-width: 540px">
        <h1 class="text-center">投稿編集</h1>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                @include('error_card_list')
                <form method="POST" action="{{ route('articles.update', ['article' => $article]) }}" novalidate enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @include('articles.form')
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">更新する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
