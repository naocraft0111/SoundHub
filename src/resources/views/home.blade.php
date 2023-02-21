@extends('layouts.app')
@section('title', 'SoundHub | SoundHub')
@section('content')
<div class="main-visual">
    <img src="{{ asset('images/top_page.jpg') }}" alt="TopPage.jpg" loading="lazy">
    <div class="main-visual__layer">
        <div class="main-visual__layer__logo">
            <img src="{{ asset('images/logo_top.png') }}" alt="logo-top.png" loading="lazy">
        </div>
        @guest
        <div class="main-visual__layer__register">
            <a class="main-visual__layer__register--btn" href="{{ route('register') }}">新規登録<i class="fas fa-angle-right fa-position-right"></i></a>
            <a class="main-visual__layer__register--btn" href="{{ route('login') }}">ログイン<i class="fas fa-angle-right fa-position-right"></i></a>
        </div>
        @endguest
    </div>
</div>
<div class="container">
    <h2 class="fw-bold h1 mb-0 text-center">SoundHubでできること</h1>
    <div class="align-items-center mt-5 row">
        <div class="col-12 col-sm-5">
            <div class="badge rounded-3 icon--background">
                <i class="fas fa-pen icon--font-size"></i>
            </div>
            <h3 class="fw-bold h2 mt-3">記事を投稿できる</h3>
            <p>
                演奏会の告知や、普段の練習風景を投稿することができます。
            </p>
        </div>
        <div class="col-12 col-sm-7">
            <img class="img-fluid rounded-3" src="{{ asset('images/articles_page.png') }}" alt="articles_page">
        </div>
    </div>
    <div class="align-items-center mt-5 row">
        <div class="col-12 col-sm-5">
            <div class="badge rounded-3 icon--background">
                <i class="fa fa-users icon--font-size"></i>
            </div>
            <h3 class="fw-bold h2 mt-3">的確なアンサンブルの相手を探すことができる</h3>
            <p>
                様々な検索条件により、登録者様にマッチングした演奏相手を探すことができます。
            </p>
        </div>
        <div class="col-12 col-sm-7">
            <img class="img-fluid rounded-3" src="{{ asset('images/search.png') }}" alt="search">
        </div>
    </div>
    <div class="align-items-center mt-5 row">
        <div class="col-12 col-sm-5">
            <div class="badge rounded-3 icon--background">
                <i class="fa fa-info-circle icon--font-size"></i>
            </div>
            <h3 class="fw-bold h2 mt-3">詳細なプロフィール欄</h3>
            <p>
                Youtube埋め込み動画や音楽性、楽器等を複数登録できます。
            </p>
        </div>
        <div class="col-12 col-sm-7">
            <img class="img-fluid rounded-3" src="{{ asset('images/user_detail.png') }}" alt="user_detail">
        </div>
    </div>
    <div class="align-items-center mt-5 row">
        <div class="col-12 col-sm-5">
            <div class="badge rounded-3 icon--background">
                <i class="fa fa-comments icon--font-size"></i>
            </div>
            <h3 class="fw-bold h2 mt-3">チャット機能</h3>
            <p>
                プライベートな事などを気軽に話せます。
            </p>
        </div>
        <div class="col-12 col-sm-7">
            <img class="img-fluid rounded-3" src="{{ asset('images/chat.png') }}" alt="chat">
        </div>
    </div>
</div>
@endsection
