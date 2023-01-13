<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

    // タグ別一覧画面
    Route::get('/tags/{name}', [TagController::class, 'show'])->name('tags.show');

    // いいね機能
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::put('/{article}/like', [ArticleController::class, 'like'])->name('like');
        Route::delete('/{article}/like', [ArticleController::class, 'unlike'])->name('unlike');
    });

    // ユーザーページ
    Route::prefix('users')->name('users.')->group(function () {
        // ユーザー詳細
        Route::get('/{name}', [UserController::class, 'show'])->name('show');

        // いいねタブ
        Route::get('/{name}/likes', [UserController::class, 'likes'])->name('likes');

        // フォロー、フォロワー一覧
        Route::get('/{name}/followings', [UserController::class, 'followings'])->name('followings');
        Route::get('/{name}/followers', [UserController::class, 'followers'])->name('followers');

        // フォロー機能
        Route::put('/{name}/follow', [UserController::class, 'follow'])->name('follow');
        Route::delete('/{name}/follow', [UserController::class, 'unfollow'])->name('unfollow');
    });
});
