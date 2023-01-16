<div class="form-group">
    @if (Auth::id() == config('user.guest_user.id'))
    <label for="name">ユーザー名</label>
    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" readonly>
    @else
    <label for="name">ユーザー名</label><span class="text-danger">【必須】</span>
    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name ?? old('name') }}" required placeholder="15文字以内で入力してください。">
    @endif
</div>
<div class="form-group mt-3">
    @if (Auth::id() == config('user.guest_user.id'))
    <label for="email">メールアドレス</label>
    <input id="email" type="text" class="form-control" name="email" value="{{ $user->email}}" readonly>
    @elseif (strpos($user->email, 'gmail.com') !== false)
    <label for="email">メールアドレス<span class="text-danger">【必須】</span></label>
        <p class="text-danger text-center mt-3">
            <b>ドメイン名を「@google.com」以外を登録した場合、<br>googleログインから認証できなくなります。</b>
        </p>
    <input id="email" type="text" class="form-control" name="email" value="{{ $user->email ?? old('email') }}" required placeholder="メールアドレスを入力しださい。">
    @else
    <label for="email">メールアドレス<span class="text-danger">【必須】</span></label>
    <input id="email" type="text" class="form-control" name="email" value="{{ $user->email ?? old('email') }}" required placeholder="メールアドレスを入力しださい。">
    @endif
</div>
