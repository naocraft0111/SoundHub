<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// トップページ
Route::get('/', [HomeController::class, 'index']);

// ゲストユーザーログイン
Route::get('guest', [LoginController::class, 'guestLogin'])->name('login.guest');

// ソーシャルログイン(すでにメールアドレスが登録済の場合)
Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('{provider}');
    Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('{provider}.callback');
});
// ソーシャルログイン(未登録)
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}', [RegisterController::class,'showProviderUserRegistrationForm'])->name('{provider}');
    Route::post('/{provider}', [RegisterController::class,'registerProviderUser'])->name('{provider}');
});

// ログイン状態でアクセス可能
Route::middleware('auth')->group(function () {
    // 記事投稿関連(CRUD)
    Route::resource('/articles', ArticleController::class);

    // 記事検索機能
    Route::get('/search', [ArticleController::class, 'search'])->name('articles.search');

    // コメント投稿関連(store, destroy)
    Route::resource('/comments', CommentController::class)->only(['store', 'destroy']);

    // タグ別一覧画面
    Route::get('/tags/{name}', [TagController::class, 'show'])->name('tags.show');

    // いいね機能
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::put('/{article}/like', [ArticleController::class, 'like'])->name('like');
        Route::delete('/{article}/like', [ArticleController::class, 'unlike'])->name('unlike');
    });

    // ユーザーページ関連
    Route::prefix('users')->name('users.')->group(function () {

        // ユーザー一覧画面
        Route::get('/', [UserController::class, 'index'])->name('index');

        // ユーザー検索
        Route::get('/search', [UserController::class, 'search'])->name('search');

        // ユーザー詳細
        Route::get('/{name}/show', [UserController::class, 'show'])->name('show');

        // プロフィール詳細
        Route::get('/{name}/detail', [UserController::class, 'detail'])->name('detail');

        // プロフィール編集画面
        Route::get('/{name}/edit', [UserController::class, 'edit'])->name('edit');

        // プロフィール更新
        Route::patch('/{name}/update', [UserController::class, 'update'])->name('update');

        // プロフィール削除
        Route::delete('/{name}/destroy', [UserController::class, 'destroy'])->name('destroy');

        // パスワード編集画面
        Route::get('/{name}/password/edit', [UserController::class, 'editPassword'])->name('password.edit');

        // パスワード更新
        Route::patch('/{name}/password/update', [UserController::class, 'updatePassword'])->name('password.update');

        // いいねタブ
        Route::get('/{name}/likes', [UserController::class, 'likes'])->name('likes');

        // フォロー、フォロワー一覧
        Route::get('/{name}/followings', [UserController::class, 'followings'])->name('followings');
        Route::get('/{name}/followers', [UserController::class, 'followers'])->name('followers');

        // フォロー機能
        Route::put('/{name}/follow', [UserController::class, 'follow'])->name('follow');
        Route::delete('/{name}/follow', [UserController::class, 'unfollow'])->name('unfollow');
    });

    // 動的プルダウン機能
    Route::post('/fetch/category', [UserController::class, 'fetch'])->name('user.fetch');
});
