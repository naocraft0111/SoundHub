@extends('layouts.app')

@section('title', 'お問い合わせメール送信完了 | SoundHub')

@section('content')
    <div class="py-4">
        <div class="container"
            style="max-width: 540px">
            <h3 class="text-center">お問い合わせ:送信完了</h3>
            <div class="alert alert-info" role="alert">
                <h5>
                    お問い合わせメールが送信されました！
                </h5>
                <a href="/" class="text-primary">
                    ホームへ戻る<i class="fas fa-chevron-circle-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
@endsection

