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
    <label for="age">年齢</label>
    <input id="age" type="text" class="form-control" name="age" value="{{ $user->age ?? old('age') }}" placeholder="年齢を入力してください">
</div>

<div>
    <label for="gender" class="mt-3 me-3">性別</label>
</div>
<div class="form-check form-check-inline">
    <input type="radio" class="form-check-input" name="gender" value="1" id="genderRadio1" @if($user->gender_id == 1) checked @endif>
    <label class="form-check-label" for="genderRadio1">男性</label>
</div>
<div class="form-check form-check-inline">
    <input type="radio" class="form-check-input" name="gender" value="2" id="genderRadio2" @if($user->gender_id == 2) checked @endif>
    <label class="form-check-label" for="genderRadio2">女性</label>
</div>
<div class="form-check form-check-inline">
    <input type="radio" class="form-check-input" name="gender" value="3"
    id="genderRadio2" @if($user->gender_id == 3) checked @endif>
    <label class="form-check-label" for="genderRadio3">その他</label>
</div>

<div class="form-group mt-3">
    <label for="pref_id">所在地</label>
    <select name="pref_id" id="pref_id" class="form-control">
        @foreach ($prefs as $pref_id => $name)
        <option value="" hidden>&#9660;選択してください</option>
        <option value="{{ $pref_id }}" @selected(old('pref_id', $user->pref_id) == $pref_id)>{{ $name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group mt-3">
    <label for="category">楽器ジャンル</label>
    <select name="primary_category_id" id="primary" class="form-control">
        <option value="0" hidden>&#9660;全て</option>
        @foreach ($primaryCategoryList as $index => $name)
        <option value="{{ $index }}">{{ $name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group mt-3">
    <label for="category">楽器名</label>
    <select name="secondary_category[]" id="secondary" class="form-control" multiple>
        <option value="" hidden>&#9660;全て</option>
        @foreach ($secondaryCategoryList as $index => $name)
        <option value="{{ $index }}">{{ $name }}</option>
        @endforeach
    </select>
</div>

<label class="mt-3">音楽性</label>
<div>
    @foreach ($sound_categories as $category)
    <div class="form-check-inline">
        <input id="{{ $category->id }}"type="checkbox" name="sound_category[]" value="{{ $category->id }}"
        @checked(old('sound_category', $user->user_soundCategories->contains('id', $category->id) ?? ''))>
        <label for="{{ $category->id }}">
            {{ $category->name }}
        </label>
    </div>
    @endforeach
</div>

<div class="form-group mt-3">
    <label for="self_introduction">自己紹介</label>
    <textarea name="self_introduction" class="form-control" rows="3" placeholder="50字以内で入力してください">{{ $user->self_introduction ?? old('self_introduction') }}</textarea>
</div>

<div class="form-group mt-3">
    <label for="prof_video_path">アピール動画</label>
    <div>例）登録したいYouTube動画のURLが <span>https://www.youtube.com/watch?v=-bNMq1Nxn5o なら"v="の直後にある "
        <span class="text-success">-bNMq1Nxn5o</span>"
        を入力
    </div>
    <input type="url" class="form-control" name="prof_video_path" placeholder="YoutubeのURLを入力してください" value="{{ $user->prof_video_path ?? old('prof_video_path') }}">
</div>
