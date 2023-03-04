@extends('layouts.app')
@section('title', 'ログイン | SoundHub')
@section('content')
    <div class="py-4">
        <div class="container"
            style="max-width: 540px">
            <h1 class="text-center">ログイン</h1>
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    @include('error_card_list')

                    <form method="POST"
                        action="{{ route('login') }}" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input id="email"
                                type="email"
                                class="form-control"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="メールアドレスを入力">
                        </div>

                        <div class="form-group mt-3">
                            <label for="password">パスワード</label>
                            <input id="password"
                                type="password"
                                class="form-control"
                                name="password"
                                required
                                placeholder="パスワードを入力">
                        </div>

                        <input type="hidden"
                            name="remember"
                            id="remember"
                            value="on">

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit"
                                class="btn btn-block text-white mt-2"
                                style="background-color: #644BFF;">
                                <b>ログイン</b>
                            </button>
                        </div>

                        <div class="card-text text-center mt-3">
                            <div class="text-center">
                                <a href="{{ route('password.request') }}"
                                    class="small">
                                    パスワード忘れた方
                                </a>
                            </div>
                        </div>
                    </form>

                    <h4 class="text-center mt-3">お手持ちのアカウントでログイン</h4>

                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('login.{provider}', ['provider' => 'google']) }}"
                            class="btn btn-block text-white"
                            style="background-color: #FF4B4B; text-transform: none;">
                            <i class="fa-brands fa-google me-2"></i><b>Googleでログイン</b>
                        </a>
                    </div>

                    <h4 class="text-center mt-3">とりあえず機能を試してみたい方はこちら</h4>

                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('login.guest') }}"
                            class="btn btn-block text-white"
                            style="background-color: #805C00;">
                            <b>ゲストユーザーログイン</b>
                        </a>
                    </div>

                    <div class="card-text text-center mt-3">
                        <div class="text-center">
                            <a href="{{ route('register') }}"
                                class="small">
                                会員登録はこちら
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
