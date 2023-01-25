@foreach ($comments as $comment)
<div class="card mt-3">
    <div class="card-body d-flex flex-row">
        <a href="{{ route('users.detail', ['name' => $comment->user->name]) }}" class="text-dark">
            @if (empty($comment->user->avatar))
            <img src="{{asset('images/user_default.png') }}" id="img" class="img-fuild rounded-circle" style="object-fit: cover;" width="50" height="50">
            @else
            <img src="{{ asset('storage/avatar/' . $comment->user->avatar) }}" id="img" class="img-fuild rounded-circle" style="object-fit: cover;" width="50" height="50">
            @endif
        </a>
        <div>
            <div class="font-weight-bold">
                <a href="{{ route('users.detail', ['name' => $comment->user->name]) }}" class="text-dark">{{ $comment->user->name }}</a>
            </div>
            <div class="font-weight-lighter">{{ $comment->created_at->format('Y/m/d H:i') }}</div>
            <small>返信先: <a href="{{ route('users.show', ['name' => $article->user->name]) }}">{{ $article->user->name }}</a> さん</small>
        </div>

        @if ( Auth::id() === $comment->user_id )
            <div class="ms-auto card-text">
                <div class="dropdown">
                    <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-link text-muted m-0 p-2" id="dropdownMenuButton"  >
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $comment->id }}">
                            <i class="fas fa-trash-alt me-1"></i>コメントを削除する
                        </a>
                    </div>
                </div>
            </div>

            <div id="modal-delete-{{ $comment->id }}" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content mx-auto">
                        <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body text-center">
                                <b>コメント</b>を削除します。よろしいですか？
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
        <div class="card-text">
            {!! nl2br(e( $comment->comment )) !!}
        </div>
    </div>
</div>
@endforeach
