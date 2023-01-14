<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content mx-auto">
            <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                <div class="modal-body text-center">
                    <small>返信先: <a href="{{ route('users.show', ['name' => $article->user->name]) }}">{{ $article->user->name }}</a> さん</small>
                    <div class="form-group">
                        <input value="{{ $article->id }}" type="hidden" name="article_id" />
                        <input value="{{ Auth::id() }}" type="hidden" name="user_id" />
                        <textarea class="form-control" type="text" name="comment" rows="5">{{ old('comment') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-block text-white"
                        style="background-color: #644BFF;"
                        type="submit">
                        <b>コメント送信</b>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
