<div class="form-group">
    <label for="title">タイトル<span class="text-danger">【必須】</span></label>
    <input id="title" type="text" class="form-control" name="title" value="{{ $article->title ?? old('title') }}" required placeholder="50字以内で入力してください">
</div>
<div class="form-group mt-3">
    <label for="body">本文<span class="text-danger">【必須】</span></label>
    <textarea name="body" class="form-control" rows="16" required placeholder="500字以内で入力してください">{{ $article->body ?? old('body') }}</textarea>
</div>
