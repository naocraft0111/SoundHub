@extends('layouts.app')
@section('title', 'パスワード再設定 | SoundHub')
@section('content')
<div class="py-4">
    <div class="container"
        style="max-width: 540px">
        <h3 class="text-center">新しいパスワードを設定</h3>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                @include('error_card_list')
                <form method="POST" action="{{ route('password.update') }}" novalidate>
                    @csrf

                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="password">新しいパスワード</label>
                        <input id="password"
                            type="password"
                            class="form-control"
                            name="password"
                            required
                            placeholder="8文字以上の半角英数で入力してください。">
                    </div>

                    <div class="form-group mt-3">
                        <label for="password_confirmation">新しいパスワード(再入力)</label>
                        <input id="password_confirmation"
                            type="password"
                            class="form-control"
                            name="password_confirmation"
                            required
                            placeholder="確認のために再度ご入力ください。">
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit"
                            class="btn btn-block text-white"
                            style="background-color: #644BFF">
                            <b>パスワードを再設定する</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
