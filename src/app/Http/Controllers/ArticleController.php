<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Image;
use App\Http\Requests\ArticleRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use Illuminate\Support\Facades\Mail;
use App\Mail\LikeNotification;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::with(['user', 'likes', 'tags', 'images'])->orderBy('created_at', 'desc')->paginate(10);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('articles.create', compact('allTagNames'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        $article->save();

        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        $imageFiles = $request->file('images');
        if(request('images')) {
        foreach($imageFiles as $imageFile) {
            $extension = $imageFile->getClientOriginalExtension();
            $filename = uniqid(rand().'_') . '.' . $extension;
            $resizeImg = InterventionImage::make($imageFile)->resize(null, 810, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode($extension);
            Storage::disk('s3')->put('image/'.$filename, $resizeImg, 'public');
            $imageModal = new Image();
            $imageModal->name = Storage::disk('s3')->url('image/'.$filename);
            $imageModal->save();
            $article->images()->attach($imageModal->id);
        }
}
        toastr()->success('投稿が完了しました');
        return to_route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $comments = $article->comments()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $tagNames = $article->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('articles.edit', compact('article', 'tagNames', 'allTagNames'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();

        $article->tags()->detach();
        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        if(!is_null($article->images)) {
            $article->images()->each(function ($image) use ($article) {
                $s3ImageUrl = $image->name;
                $existsArticlesImg = basename($s3ImageUrl);
                if (Storage::disk('s3')->exists('image/' . $existsArticlesImg)) {
                    Storage::disk('s3')->delete('image/' . $existsArticlesImg);
                }
                $article->images()->detach($image->id);
                $image->delete();
            });
        }

        $imageFiles = $request->file('images');
        if(request('images')) {
            foreach($imageFiles as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = uniqid(rand().'_') . '.' . $extension;
                $resizeImg = InterventionImage::make($imageFile)->resize(null, 810, function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode($extension);
                Storage::disk('s3')->put('image/'.$filename, $resizeImg, 'public');
                $imageModal = new Image();
                $imageModal->name = Storage::disk('s3')->url('image/'.$filename);
                $imageModal->save();
                $article->images()->attach($imageModal->id);
            }
        }
        toastr()->success('投稿を更新しました');
        return to_route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // 記事と紐づいている画像を削除
        $article->images()->each(function ($image) use ($article) {
            $s3ImageUrl = $image->name;
            $existsArticlesImg= basename($s3ImageUrl);
            if (Storage::disk('s3')->exists('image/' . $existsArticlesImg)) {
                Storage::disk('s3')->delete('image/' . $existsArticlesImg);
            }
            $article->images()->detach($image->id);
            $image->delete();
        });

        $article->delete();
        toastr()->success('投稿を削除しました');
        return to_route('articles.index');
    }

    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        // いいねを受け取ったユーザーの情報を取得
        $receiver = $article->user;

        // いいねを送信したユーザーの情報を取得
        $sender = $request->user();

        // 自分自身に対して、いいねをしていない場合のみメール通知を送信する
        if($receiver->id !== $sender->id) {
            // 受け取るメールアドレスを取得
            $to = $receiver->email;

            // メール通知を送信
            Mail::to($to)->send(new LikeNotification($sender, $article));
        }
        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function search(Request $request)
    {
        $articles = Article::searchFilter($request->search)
            ->orderBy('created_at', 'desc')
            ->with(['user', 'likes', 'tags'])
            ->paginate(10);

        return view('articles.index', compact('articles'));
    }
}
