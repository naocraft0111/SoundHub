<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PrimaryCategory;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\SecondaryCategory;
use App\Models\SoundCategory;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class UserController extends Controller
{
    // ユーザーページ表示
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()->load(['articles.user', 'articles.likes', 'articles.tags', 'articles.images']);

        $articles = $user->articles()->orderBy('created_at', 'desc')->paginate(10);

        return view('users.show', compact('user', 'articles'));
    }

    // ユーザー一覧画面
    public function index(Request $request)
    {
        $query = User::query();
        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        $prefs = config('pref');

        $primaryCategoryList = PrimaryCategory::pluck('name', 'id');
        $secondaryCategoryList = SecondaryCategory::pluck('name', 'id');

        $sound_categories = SoundCategory::pluck('name', 'id');

        return view('users.index', compact('users', 'prefs', 'primaryCategoryList', 'secondaryCategoryList' ,'sound_categories'));
    }

    // ユーザー検索
    public function search(Request $request)
    {
        $inputs = $request->all();
        $prefs = config('pref');

        $primaryCategoryList = PrimaryCategory::pluck('name', 'id');
        $secondaryCategoryList = SecondaryCategory::pluck('name', 'id');

        $sound_categories = SoundCategory::pluck('name', 'id');

        $users = User::nameFilter($request->name)
            ->ageFromFilter($request->age_from)
            ->ageToFilter($request->age_to)
            ->genderFilter($request->gender)
            ->prefFilter($request->pref)
            ->secondaryCategory($request->secondary_category)
            ->soundCategoryFilter($request->sound_category)
            ->paginate(10);

        return view('users.index', compact('users', 'prefs', 'primaryCategoryList', 'secondaryCategoryList' ,'sound_categories', 'inputs'));
    }

    public function detail(string $name)
    {
        $user = User::where('name', $name)->first();

        $prefs = config('pref');
        $genders = config('gender');

        return view('users.detail', compact('user', 'prefs', 'genders'));
    }

    // プロフィール編集画面
    public function edit(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        $prefs = config('pref');

        $primaryCategoryList = PrimaryCategory::pluck('name', 'id');
        $secondaryCategoryList = SecondaryCategory::pluck('name', 'id');

        $sound_categories = SoundCategory::all();

        return view('users.edit', compact('user', 'prefs', 'primaryCategoryList', 'secondaryCategoryList' ,'sound_categories'));
    }

    // プロフィール更新処理
    public function update(UserRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        $imageFile = $request->file('avatar');
        if(request('avatar')) {
            $filePath = 'public/avatar/' . $user->avatar;
            if(Storage::exists($filePath)){
                Storage::delete($filePath);
            }
            $fileNameToStore = ImageService::upload($imageFile, 'avatar');
            $user->avatar = $fileNameToStore;
        }

        $user->user_secondaryCategories()->detach();
        $user->user_secondaryCategories()->attach($request->secondary_category);
        $user->user_soundCategories()->detach();
        $user->user_soundCategories()->attach($request->sound_category);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender_id = $request->gender;
        $user->pref_id = $request->pref_id;
        $user->self_introduction = $request->self_introduction;
        $user->prof_video_path = $request->prof_video_path;
        $user->save();

        toastr()->success('プロフィールを更新しました');
        return to_route('users.detail', ['name' => $user->name]);
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

        toastr()->success('パスワードを更新しました');
        return to_route('users.detail', ['name' => $user->name]);
    }

    // 退会
    public function destroy(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        // UserPolicyのdeleteメソッドでアクセス制限
        $this->authorize('delete', $user);

        $user->delete();
        Auth::logout();
        toastr()->success('退会処理が完了しました');
        return redirect('/');
    }

    // いいね記事
    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes', 'likes.tags']);

        $articles = $user->likes()->orderBy('created_at', 'desc')->paginate(10);

        return view('users.likes', compact('user', 'articles'));
    }

    // フォロー一覧
    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()->load('followings.followers');

        $followings = $user->followings()->orderBy('created_at', 'desc')->paginate(5);

        return view('users.followings', compact('user', 'followings'));
    }

    // フォロワー一覧
    public function followers(string $name)
    {
        $user = User::where('name', $name)->first()->load('followers.followers');

        $followers = $user->followers()->orderBy('created_at', 'desc')->paginate(5);

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

    // ajaxリクエストを受け取り、サブカテゴリを返す
    public function fetch(Request $request) {
        $cateVal = $request['category_val'];
        $secondary = SecondaryCategory::where('primary_category_id', $cateVal)->get();
        return $secondary;
    }
}
