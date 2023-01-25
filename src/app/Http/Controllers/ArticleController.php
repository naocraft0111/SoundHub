<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Image;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;

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
    public function index()
    {
        $articles = Article::all()->sortByDesc('created_at')->load(['user', 'likes', 'tags', 'images']);
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

        if(request('images')) {
            $images = $request->file('images');
            foreach($images as $image) {
                Storage::putFile('public/images', $image);
                $imageModal = new Image();
                $imageModal->name = $image->hashName();
                $imageModal->save();
                $article->images()->attach($imageModal->id);
            }
        }

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
            ->get();

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

        if(isset($article->images)) {
            $article->images()->each(function ($image) use ($article) {
                $filePath = 'public/images/' . $image->name;
                if(Storage::exists($filePath)){
                    Storage::delete($filePath);
                }
                $article->images()->detach($image->id);
                $image->delete();
            });
        }

        if(request('images')) {
            $images = $request->file('images');
            foreach($images as $image) {
                Storage::putFile('public/images', $image);
                $imageModal = new Image();
                $imageModal->name = $image->hashName();
                $imageModal->save();
                $article->images()->attach($imageModal->id);
            }
        }

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
            $filePath = 'public/images/' . $image->name;
            if(Storage::exists($filePath)){
                Storage::delete($filePath);
            }
            $article->images()->detach($image->id);
            $image->delete();
        });

        $article->delete();
        return to_route('articles.index');
    }

    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

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
}
