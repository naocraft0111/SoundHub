@extends('layouts.app')

@section('title', 'プロフィール編集画面 | SoundHub')

@section('content')
<div class="py-4">
    <div class="container"
        style="max-width: 540px">
        <h1 class="text-center">プロフィール編集</h1>

        @if (session('status'))
        <div class="card-text alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        @if (Auth::id() == config('user.guest_user.id'))
        <div class="card-body text-center">
            <p class="text-danger">
                <b>※ゲストユーザーは、以下の項目を変更できません。</b><br>
                    ・プロフィール画像<br>
                    ・ユーザー名<br>
                    ・メールアドレス<br>
            </p>
        </div>
        @endif
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                @include('error_card_list')
                {{-- ユーザー更新 --}}
                <form method="POST" action="{{ route('users.update', ['name' => $user->name]) }}" enctype="multipart/form-data" novalidate>
                @method('PATCH')
                @csrf
                @include('users.form')
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">更新する</button>
                </div>
                </form>
                {{-- パスワード変更 --}}
                @unless(Auth::id() == config('user.guest_user.id'))
                <div class="d-grid gap-2 mt-3">
                    <a href="{{ route('users.password.edit', ['name' => $user->name]) }}" class="btn btn-light border text-dark text-center text-decoraiton-none a_btn" role="button">パスワード変更</a>
                </div>
                {{-- ユーザー削除 --}}
                <div class="d-grid gap-2 mt-3">
                    <a class="btn btn-danger text-center a_btn" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $user->id }}">
                        退会する
                    </a>
                </div>
                {{-- ユーザー削除モーダル --}}
                <div id="modal-delete-{{ $user->id }}" class="modal fade" tab-index="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content mx-auto">
                            <form method="POST" action="{{ route('users.destroy', ['name' => $user->name]) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body text-center">
                                    {{ $user->name }} 様を退会します。よろしいですか？
                                </div>
                                <div class="modal-footer justify-content-evenly">
                                    <a class="btn btn-outline-dark" data-bs-dismiss="modal">キャンセル</a>
                                    <button type="submit" class="btn btn-danger">削除する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endunless
            </div>
        </div>
    </div>
@endsection
