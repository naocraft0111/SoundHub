<p>{{ $user->name }}さんが「{{ $article->title }}」の記事にいいねを送信しました。</p>
<p><a href="{{ route('articles.show', $article->id) }}">記事を確認する</a></p>
SoundHub({{ url(config('app.url')) }})
