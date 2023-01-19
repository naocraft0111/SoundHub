<div class="form-group">
    <label class="form-label d-block text-dark" for="avatar">プロフィール画像（サイズは1024Kbyteまで）</label>
    @if (Auth::id() == config('user.guest_user.id'))
    <img src="{{ asset('images/user_default.png') }}" id="img" class="img-fuild rounded-circle" style="object-fit: cover;" width="50" height="50">
    @elseif(empty($user->avatar))
    <img src="{{ asset('images/user_default.png') }}" id="img" class="img-fuild rounded-circle" style="object-fit: cover;" width="50" height="50">
    <input id="avatar" type="file" name="avatar" accept="image/png,image/jpeg,image/jpg">
    @else
    <img src="{{ $user->avatar }}" id="img" class="img-fuild rounded-circle" style="object-fit: cover;" width="50" height="50">
    <input id="avatar" type="file" name="avatar" accept="image/png,image/jpeg,image/jpg">
    @endif
</div>
<div class="form-group mt-3">
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
    <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" readonly>
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
<div class="form-group mt-3">
    @if (Auth::id() == config('user.guest_user.id'))
    <label for="age">年齢</label>
    <input id="age" type="text" class="form-control" name="age" value="{{ $user->age}}" disabled>
    @else
    <label for="age">年齢</label>
    <input id="age" type="text" class="form-control" name="age" value="{{ $user->age ?? old('age') }}" placeholder="年齢を入力してください">
    @endif
</div>
<div>
    <label for="gender" class="mt-3 me-3">性別</label>
</div>

<div class="form-check form-check-inline">
    @if (Auth::id() == config('user.guest_user.id'))
    <input type="radio" class="form-check-input" name="gender" value="1" id="genderRadio1" disabled>
    @else
    <input type="radio" class="form-check-input" name="gender" value="1" id="genderRadio1" @if($user->gender_id == 1) checked @endif>
    @endif
    <label class="form-check-label" for="genderRadio1">男性</label>
</div>
<div class="form-check form-check-inline">
    @if (Auth::id() == config('user.guest_user.id'))
    <input type="radio" class="form-check-input" name="gender" value="2" id="genderRadio2" disabled>
    @else
    <input type="radio" class="form-check-input" name="gender" value="2" id="genderRadio2" @if($user->gender_id == 2) checked @endif>
    @endif
    <label class="form-check-label" for="genderRadio2">女性</label>
</div>
<div class="form-check form-check-inline">
    @if (Auth::id() == config('user.guest_user.id'))
    <input type="radio" class="form-check-input" name="gender" value="3" id="genderRadio3" disabled>
    @else
    <input type="radio" class="form-check-input" name="gender" value="3"
    id="genderRadio2" @if($user->gender_id == 3) checked @endif>
    @endif
    <label class="form-check-label" for="genderRadio3">どちらでもない</label>
</div>
<div class="form-group mt-3">
    <label for="pref_id">所在地</label>
    @if (Auth::id() == config('user.guest_user.id'))
    <select name="pref_id" id="pref_id" class="form-control" disabled>
        <option value="">選択できません</option>
    </select>
    @else
    <select name="pref_id" id="pref_id" class="form-control">
        @foreach ($prefs as $pref_id => $name)
        <option value="" hidden>&#9660;選択してください</option>
        <option value="{{ $pref_id }}" @selected(old('pref_id', $user->pref_id) == $pref_id)>{{ $name }}</option>
        @endforeach
    </select>
    @endif
</div>
<div class="form-group mt-3">
    <label for="instrument_years_id">楽器経験年数</label>
    @if (Auth::id() == config('user.guest_user.id'))
    <select name="pref_id" id="pref_id" class="form-control" disabled>
        <option value="">選択できません</option>
    </select>
    @else
    <select class="form-control" name="instrument_years_id" id="instrument_years_id">
        @foreach ($instrument_years as $instrument_years_id => $name)
        <option value="" hidden>&#9660;選択してください</option>
        <option value="{{ $instrument_years_id }}" @selected(old('instrument_years_id', $user->instrument_years_id) == $instrument_years_id)>{{ $name }}</option>
        @endforeach
    </select>
    @endif
</div>
<div class="form-group mt-3">
    <label for="self_introduction">自己紹介</label>
    @if (Auth::id() == config('user.guest_user.id'))
    <textarea name="self_introduction" class="form-control" rows="3" placeholder="入力できません" disabled></textarea>
    @else
    <textarea name="self_introduction" class="form-control" rows="3" placeholder="50字以内で入力してください">{{ $user->self_introduction ?? old('self_introduction') }}</textarea>
    @endif
</div>
<div class="form-group mt-3">
    <label for="prof_video_path">アピール動画</label>
    <div>例）登録したいYouTube動画のURLが <span>https://www.youtube.com/watch?v=-bNMq1Nxn5o なら"v="の直後にある "
        <span class="text-success">-bNMq1Nxn5o</span>"
        を入力
    </div>
    @if (Auth::id() == config('user.guest_user.id'))
    <input type="url" class="form-control" name="prof_video_path" placeholder="入力できません" value="" disabled>
    @else
    <input type="url" class="form-control" name="prof_video_path" placeholder="YoutubeのURLを入力してください" value="{{ $user->prof_video_path ?? old('prof_video_path') }}">
    @endif
</div>
