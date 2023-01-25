<div class="form-group">
    <label for="title">タイトル<span class="text-danger">【必須】</span></label>
    <input id="title" type="text" class="form-control" name="title" value="{{ $article->title ?? old('title') }}" required placeholder="50字以内で入力してください">
</div>
<div class="form-group mt-3">
    <article-tags-input
        :initial-tags='@json($tagNames ?? [])'
        :autocomplete-items='@json($allTagNames ?? [])'>
    </article-tags-input>
</div>
<div class="form-group mt-3">
    <label for="body">本文<span class="text-danger">【必須】</span></label>
    <textarea name="body" class="form-control" rows="16" required placeholder="500字以内で入力してください">{{ $article->body ?? old('body') }}</textarea>
</div>
<div class="form-group mt-3">
    <label for="images">画像</label><span class="text-danger">（4枚までアップロード可能です）</span></label>
    @if (Route::currentRouteName() === 'articles.edit')
    <p class="text-danger">※こちらに投稿されている画像が全て上書きされます。</p>
    @endif
    <input type="file" class="form-control" id="images" name="images[][image]" accept="image/*" multiple>
</div>
