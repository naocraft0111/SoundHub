@extends('layouts.app')

@section('title', 'お問い合わせ | SoundHub')

@section('content')
    <div class="py-4">
        <div class="container"
            style="max-width: 540px">
            <h3 class="text-center">お問い合わせ</h3>
            <p>
                SoundHubに対するご意見・お問い合わせなどございましたらお聞かせください。<br>
                お送りいただいた内容は全て確認しておりますが、ご返信を差し上げることができない場合がございますので、ご了承ください。
            </p>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @include('error_card_list')
                    <form method="POST"
                        action="{{ route('contact.confirm') }}"
                        novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="name">お名前<span class="text-danger">【必須】</span></label>
                            <input type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                required
                                value="{{ Auth::user()->name ?? old('name') }}"
                                placeholder="お名前を入力してください。">
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">メールアドレス<span class="text-danger">【必須】</span></label>
                            <input type="text"
                                class="form-control"
                                name="email"
                                id="email"
                                required
                                value="{{ Auth::user()->email ?? old('email') }}"
                                placeholder="（例）email@example.com">
                        </div>

                        <div class="form-group mt-3">
                            <label for="title">ご用件</label>
                            <input type="title"
                                class="form-control"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="ご用件を入力してください。">
                        </div>

                        <div class="form-group mt-3">
                            <label for="body">お問い合わせ内容<span class="text-danger">【必須】</span></label>
                            <textarea type="text"
                                class="form-control"
                                name="body"
                                id="body"
                                required
                                rows="5"
                                placeholder="1000文字以内で入力してください。">{{ old('body') }}
                            </textarea>
                        </div>

                        <label for="agree" class="small mt-2" role="button">
                            <span class="d-flex flex-wrap">
                                <span>
                                    <input type="checkbox" id="agree" name="agree" required>
                                    <a href="{{ route('privacy') }}" class="text-primary ms-2" target="_blank"
                                    title="プライバシーポリシーをブラウザの別画面で開く">プライバシーポリシー</a>
                                    <span>を確認し、</span>
                                </span>
                                <span>同意</span>
                                <span>
                                    <span>
                                        <span>しました。</span><span class="text-danger">【必須】</span>
                                    </span>
                                </span>
                            </span>
                        </label>

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit"
                                class="btn btn-block text-white"
                                style="background-color: #644BFF;">
                                <b>送信内容を確認する</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
