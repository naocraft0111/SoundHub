<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TagController;

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
// 記事投稿関連(CRUD)
Route::resource('/articles', ArticleController::class)->middleware('auth');
// いいね機能
Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', [ArticleController::class, 'like'])->name('like')->middleware('auth');
    Route::delete('/{article}/like', [ArticleController::class, 'unlike'])->name('unlike')->middleware('auth');
});
// タグ別一覧画面
Route::get('/tags/{name}', [TagController::class, 'show'])->name('tags.show')->middleware('auth');
