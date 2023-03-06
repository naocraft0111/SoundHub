@extends('layouts.app')
@section('title', 'パスワード再設定 | SoundHub')
@section('content')
<div class="py-4">
    <div class="container"
        style="max-width: 540px">
        <h1 class="text-center">パスワード再設定</h1>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @include('error_card_list')

                <form method="POST" action="{{ route('password.email') }}" novalidate>
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

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit"
                            class="btn btn-block text-white"
                            style="background-color: #644BFF">
                            <b>送信する</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
