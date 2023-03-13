<p>{{ $senderName }}さんから新しいメッセージが届きました。</p>
<p>メッセージ内容：{{ $body }}</p>
<p>下記URLからチャットメッセージを確認してください。</p>
<p>{{ route('chat') }}</p>
SoundHub({{ url(config('app.url')) }})
