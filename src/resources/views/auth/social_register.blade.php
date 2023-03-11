@extends('layouts.app')
@section('title', '会員登録 | SoundHub')
@section('content')
<div class="py-4">
    <div class="container"
        style="max-width: 540px">
        <h1 class="text-center">SoundHubに会員登録</h1>
        <div class="card shadow-sm mb-4">
                <div class="card-body">

                    @include('error_card_list')

                    <form method="POST" action="{{ route('register.{provider}', ['provider' => $provider]) }}" novalidate>
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input id="email" type="text" class="form-control" name="email" value="{{ $email }}" disabled placeholder="（例）email@example.com">
                        </div>

                        <div class="form-group mt-3">
                            <label for="name">ユーザー名<span class="text-danger">【必須】</span></label>
                            <input id="name" type="text" class="form-control" name="name" required placeholder="15文字以内で入力してください。">
                        </div>

                        <div class="form-group mt-3">
                            <label for="password">パスワード<span class="text-danger">【必須】</span></label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="8文字以上の半角英数で入力してください。" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="password-confirm">パスワード（確認）<span class="text-danger">【必須】</span></label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="確認のために再度ご入力ください。" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="birthday">生年月日（任意）<br><span class="text-danger">※会員登録後、生年月日を保存、変更できません。</span></label>
                            @livewire('birthday')
                        </div>

                        <div class="card-text text-center mt-3">
                            <p class="text-center small">
                                <span>会員登録には、</span>
                                <a href="">利用規約</a>
                                <span>と</span>
                                <a href="">プライバシーポリシー</a>
                                <span>への同意が必要です。</span>
                            </p>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit"
                                class="btn btn-block text-white"
                                style="background-color: #644BFF;">
                                <b>同意して登録する</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
