@extends('layouts.app')

@section('title', 'SoundHub | 新規投稿')
@section('content')
<div class="container">
    {{ Breadcrumbs::render('articles.create') }}
</div>
<div class="py-4">
    <div class="container"
        style="max-width: 540px">
        <h1 class="text-center">新規投稿</h1>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                @include('error_card_list')
                <form method="POST" action="{{route('articles.store')}}" novalidate enctype="multipart/form-data">
                    @csrf
                    @include('articles.form')
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">投稿する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
