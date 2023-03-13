<p>{{ $user->name }}さんがあなたをフォローしました。</p>
<p>ユーザー名: {{ $user->name }}</p>
<p>プロフィールURL: {{ route('users.show', $user->name) }}</p>
SoundHub({{ url(config('app.url')) }})
