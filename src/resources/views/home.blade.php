@extends('layouts.app')
@section('title', 'SoundHub')
@section('content')
<div class="main-visual">
    <img src="{{ asset('images/top_page.jpg') }}" alt="TopPage.jpg" loading="lazy">
    <div class="main-visual__layer">
        <div class="main-visual__layer__logo">
            <img src="{{ asset('images/logo_top.png') }}" alt="logo-top.png" loading="lazy">
        </div>
        <div class="main-visual__layer__description">
            <a class="main-visual__layer__description--btn" href="#SoundHub-description">SoundHubとは?<i class="fas fa-angle-right fa-position-right"></i></a>
        </div>
        @guest
        <div class="main-visual__layer__register">
            <a class="main-visual__layer__register--btn" href="{{ route('register') }}">新規登録<i class="fas fa-angle-right fa-position-right"></i></a>
            <a class="main-visual__layer__register--btn" href="{{ route('login') }}">ログイン<i class="fas fa-angle-right fa-position-right"></i></a>
        </div>
        @endguest
    </div>
</div>
<section id="SoundHub-description">
    <div class="container">
        <div class="SoundHub-what">
            <h2 class="fw-bold h1 mb-0 text-center">SoundHubとは？</h2>
            <h4 class="my-5 text-center">
                音楽仲間を探すためのオンラインマッチングSNSです。<br>
                バンドメンバーや伴奏者を探したり、一緒に演奏できる相手を見つけましょう。<br>
                フォローやチャットを通じて交流し、充実した音楽ライフを送りましょう。<br>
            </h4>
        </div>
        <h2 class="fw-bold h1 mt-5 text-center">SoundHubでできること</h2>
        <div class="align-items-center mt-5 row">
            <div class="col-12 col-sm-5">
                <div class="badge rounded-3 icon--background">
                    <i class="fas fa-pen icon--font-size"></i>
                </div>
                <h3 class="fw-bold h2 mt-3">記事を投稿できる</h3>
                <p>
                    投稿にはタイトル名、本文、複数画像投稿、タグ付けすることができます。
                    画像の通り、演奏会の告知等を投稿することができます。
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
                <h3 class="fw-bold h2 mt-3">演奏の相手を探すための検索システム</h3>
                <p>
                    検索条件に基づいて情報を入力することで、自分が探している相手を見つけてマッチングすることができます。
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
                    マイページのプロフィール編集ボタンから、様々な情報を登録できます。
                    画像の通り、Youtube埋め込み動画や音楽性、楽器名等を複数登録できます。
                    詳細な情報を登録することで、他のユーザーから見つけやすくなります。
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
                    相手のプロフィールページのチャット追加ボタンから、チャットしたい相手を登録できます。
                    プライベートなことや、好きな音楽の話、趣味の話などを共有できます。
                </p>
            </div>
            <div class="col-12 col-sm-7">
                <img class="img-fluid rounded-3" src="{{ asset('images/chat.png') }}" alt="chat">
            </div>
        </div>
    </div>
</section>
@endsection
