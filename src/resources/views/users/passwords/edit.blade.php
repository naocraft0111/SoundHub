@extends('layouts.app')
@section('title', 'パスワード変更 | SoundHub')
@section('content')
<div class="container">
    {{ Breadcrumbs::render('users.password.edit', $user) }}
</div>
<div class="py-4">
    <div class="container"
        style="max-width: 540px">
        <h1 class="text-center">パスワード変更</h1>
        @if (session('status'))
        <div class="card-text alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        @if (Auth::id() == config('user.guest_user.id'))
        <div class="card-body text-center">
            <p class="text-danger">
                <b>※ゲストユーザーは、パスワードを編集できません。</b>
            </p>
        </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                @include('error_card_list')
                <form method="POST" action="{{ route('users.password.update', ['name' => $user->name]) }}" novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="current_password">現在のパスワード</label>
                        <input id="current_password"
                            type="password"
                            class="form-control"
                            name="current_password"
                            required
                            placeholder="8文字以上の半角英数で入力してください。">
                    </div>

                    <div class="form-group mt-3">
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
                            <b>パスワードを変更する</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
