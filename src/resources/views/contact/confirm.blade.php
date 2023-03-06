@extends('layouts.app')

@section('title', 'お問い合わせ内容の確認 | SoundHub')

@section('content')
    <div class="py-4">
        <div class="container"
            style="max-width: 540px">
            <h1 class="text-center">お問い合わせ内容の確認</h1>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="post"
                        action="{{ route('contact.send') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">お名前</label>
                            <p>
                                {{ $inputs['name'] }}
                            </p>
                            <input type="hidden"
                                name="name"
                                value="{{ $inputs['name'] }}">
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">メールアドレス</label>
                            <p>
                                {{ $inputs['email'] }}
                            </p>
                            <input type="hidden"
                                name="email"
                                value="{{ $inputs['email'] }}">
                        </div>

                        <div class="form-group mt-3">
                            <label for="title">ご用件</label>
                            <p>
                                @if ($inputs['title'] !== null)
                                    {{ $inputs['title'] }}
                                @else
                                無題
                                @endif
                            </p>
                            <input type="hidden"
                                name="title"
                                value="{{ $inputs['title'] }}">
                        </div>

                        <div class="form-group mt-3">
                            <label for="body">お問い合わせ内容</label>
                            <p>
                                {!! nl2br(e($inputs['body'], false)) !!}
                            </p>
                            <input name="body" value="{{ $inputs['body'] }}" type="hidden">
                        </div>

                        <input name="agree" value="{{ $inputs['agree'] }}" type="hidden">

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit"
                                name="back"
                                value="back"
                                class="btn btn-block text-white"
                                style="background-color: #FF4B4B;">
                                <b>入力内容修正</b>
                            </button>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit"
                                name="action"
                                value="submit"
                                class="btn btn-block text-white"
                                style="background-color: #644BFF;">
                                <b>送信する</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
