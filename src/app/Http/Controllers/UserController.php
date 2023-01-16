<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdatePasswordRequest;

class UserController extends Controller
{
    // ユーザーページ表示
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()->load(['articles.user', 'articles.likes', 'articles.tags']);

        $articles = $user->articles->sortByDesc('created_at');

        return view('users.show', compact('user', 'articles'));
    }

    // プロフィール編集画面
    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    // プロフィール更新処理
    public function update(UserRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        $user->fill($request->validated())->save();

        return to_route('users.show', ['name' => $user->name]);
    }

    // パスワード変更画面
    public function editPassword(string $name)
    {
        $user = User::where('name', $name)->first();

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        return view('users.passwords.edit', compact('user'));
    }

    // パスワード変更処理
    public function updatePassword(UpdatePasswordRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        // 現在のパスワードの合致しているかチェック
        if(!(Hash::check($request->current_password, $user->password)))
        {
            return redirect()->back()->withInput()->withErrors(['current_password' => '現在のパスワードが違います']);
        }

        // 現在のパスワードと新しいパスワードが違うかチェック
        if(Hash::check($request->current_password, $request->password))
        {
            return redirect()->back()->withInput()->withErrors(['current_password' => '新しいパスワードが、現在のパスワードと同じです。違うパスワードを設定してください']);
        }

        $user->password = Hash::make($request['password']);
        $user->save();

        return to_route('users.edit', ['name' => $user->name])->with('status', 'パスワードを変更しました。');
    }

    // 退会
    public function destroy(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        // UserPolicyのdeleteメソッドでアクセス制限
        $this->authorize('delete', $user);

        $user->delete();
        Auth::logout();

        return redirect('/');
    }

    // いいね記事
    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes', 'likes.tags']);

        $articles = $user->likes->sortByDesc('created_at');

        return view('users.likes', compact('user', 'articles'));
    }

    // フォロー一覧
    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()->load('followings.followers');

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', compact('user', 'followings'));
    }

    // フォロワー一覧
    public function followers(string $name)
    {
        $user = User::where('name', $name)->first()->load('followers.followers');

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', compact('user', 'followers'));
    }

    // フォロー
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if($user->id === $request->user()->id)
        {
            return abort('404', '自分自身をフォローをすることはできません。');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }

    // フォロー解除
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if($user->id === $request->user()->id)
        {
            return abort('404', '自分自身をフォローをすることはできません。');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }

}
