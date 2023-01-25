<div class="card mt-3">
    <div class="card-body d-flex flex-row">
        <a href="{{ route('users.detail', ['name' => $article->user->name]) }}"
            class="text-dark">
            @if (empty($article->user->avatar))
            <img src="{{asset('images/user_default.png') }}" id="img" class="img-fuild rounded-circle" style="object-fit: cover;" width="50" height="50">
            @else
            <img src="{{ asset('storage/avatar/' . $article->user->avatar) }}" id="img" class="img-fuild rounded-circle" style="object-fit: cover;" width="50" height="50">
            @endif
        </a>
        <div>
            <div class="font-weight-bold">
                <a href="{{ route('users.detail', ['name' => $article->user->name]) }}" class="text-dark">
                    {{ $article->user->name }}
                </a>
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
                        <button type="button" class="btn btn-link text-muted m-0 p-2" id="dropdownMenuButton">
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
            <a href="{{ route('articles.show', ['article' => $article]) }}">
                {{ $article->title }}
            </a>
        </h4>
        <div class="card-text">
            {!! nl2br(e( $article->body )) !!}
        </div>
        <div class="px-2">
            <div class="gallery-list d-flex justify-content-center mx-n2">
                @foreach ($article->images as $image)
                <div class="px-2 mt-5" style="width: 16.666667%;">
                    <a href="{{ asset('storage/images/' . $image->name) }}" class="gallery" data-group="gallery{{ $article->id }}">
                        <img src="{{ asset('storage/images/' . $image->name) }}" class="mw-100" style="object-fit: cover;" alt="{{ $image->name }}">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card-body pt-0 pb-2 ps-3">
        <div class="card-text d-flex align-items-center">
            <div class="d-flex align-items-center">
                <a class="pe-1" data-bs-toggle="modal" data-bs-target="#commentModal">
                    <i class="far fa-comment text-secondary"></i>
                </a>
                <p class="mb-0 pe-1 ps-1 text-secondary" style="padding-bottom: 2.0px;">
                    {{ count($article->comments) }}
                </p>
                <article-like
                    :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))'
                    :initial-count-likes='@json($article->count_likes)'
                    :authorized='@json(Auth::check())'
                    endpoint="{{ route('articles.like', ['article' => $article]) }}"
                >
                </article-like>
            </div>
        </div>
    </div>

    @include('comments.form')

    @foreach ($article->tags as $tag)
        @if ($loop->first)
            <div class="card-body pt-0 pb-4 ps-3">
                <div class="card-text line-height">
        @endif
                    <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 me-1 mt-1 text-muted">
                        {{ $tag->hashtag }}
                    </a>
        @if($loop->last)
                </div>
            </div>
        @endif
    @endforeach
</div>
