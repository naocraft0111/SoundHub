<div class="card mt-3">
    <div class="card-body d-flex flex-row">
        <i class="fas fa-user-circle fa-3x me-1"></i>
        <div>
            <div class="font-weight-bold">
                {{ $article->user->name }}
            </div>
            <div class="font-weight-lighter">
                {{ $article->created_at->format('Y/m/d H:i') }}
            </div>
        </div>
        @if(Auth::id() === $article->user_id)
            {{-- ドロップダウン --}}
            <div class="ms-auto card-text">
                <div class="dropdown">
                    <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-link text-muted m-0 p-2" id="dropdownMenuButton"  >
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('articles.edit', ['article' => $article]) }}">
                            <i class="fas fa-pen me-1"></i>記事を更新する
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $article->id }}">
                            <i class="fas fa-trash-alt me-1"></i>記事を削除する
                        </a>
                    </div>
                </div>
            </div>

            {{-- モーダル --}}
            <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content mx-auto">
                        <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body text-center">
                                {{ $article->title }}を削除します。よろしいですか？
                            </div>
                            <div class="modal-footer justify-content-evenly">
                                <a class="btn btn-outline-dark" data-bs-dismiss="modal">キャンセル</a>
                                <button type="submit" class="btn btn-danger">削除する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="card-body pt-0 pb-2">
        <h4 class="card-title">
            <a class="text-decoration-none" href="{{ route('articles.show', ['article' => $article]) }}">
                {{ $article->title }}
            </a>
        </h4>
        <div class="card-text">
            {!! nl2br(e( $article->body )) !!}
        </div>
    </div>
</div>

