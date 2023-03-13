<p>{{ $user->name }}さんが{{ $comment->article->title }}の記事にコメントを投稿しました。</p>
    <p>コメント内容：{{ $comment->comment }}</p>
    <p><a href="{{ route('articles.show', $comment->article) }}">記事を確認する</a></p>
SoundHub({{ url(config('app.url')) }})
