<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * プロフィール詳細画面
     */
    public function test_detail()
    {
        $response = $this->actingAs($this->user)
            ->get(route('users.detail', ['name' => $this->user->name]));
        $response->assertStatus(200);
    }

    /**
     * ユーザー情報更新
     */
    public function test_update(){
        $response = $this->actingAs($this->user)
            ->from(route('users.edit', ['name' => $this->user->name]))
            ->patch(
                route('users.update', ['name' => $this->user->name]), [
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'gender' => 1,
                    'pref_id' => 3,
                    'prof_video_path' => '-bNMq1Nxn5o',
                    'self_introduction' => 'aaa',
                ]);
        $response->assertRedirect(route('users.detail', ['name' => $this->user->name]));
        $this->assertDatabaseHas('users', [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'gender_id' => 1,
            'pref_id' => 3,
            'prof_video_path' => '-bNMq1Nxn5o',
            'self_introduction' => 'aaa',
        ]);
    }

    /**
     * カテゴリー関連更新テスト
     */
    public function test_UpdateCategories()
    {
        $secondaryCategory = [1, 2, 3];
        $soundCategory = [1, 2, 3];
        $user = User::factory()->create();
        $this->seed('categorySeeder');

        $user->user_secondaryCategories()->attach($secondaryCategory);
        $user->user_soundCategories()->attach($soundCategory);

        // Assert
        $this->assertDatabaseHas('secondary_category_user', [
            'secondary_category_id' => $secondaryCategory
        ]);
        $this->assertDatabaseHas('sound_category_user', [
            'sound_category_id' => $soundCategory
        ]);
    }

    /**
     * 退会処理
     */
    public function test_delete()
    {
        // テストに必要なデータを用意する
        $user = User::factory()->create();

        //
        Storage::fake('s3');
        $imageFile = UploadedFile::fake()->image('avatar.jpg');
        Storage::disk('s3')->putFileAs('avatar', $imageFile, 'avatar.jpg');
        $user->avatar = Storage::disk('s3')->url('avatar/avatar.jpg');

        // 退会処理のリクエストを作成する
        $response = $this->actingAs($user)->delete(route('users.destroy', ['name' => $user->name]));

        // レスポンスを検証する
        $response->assertStatus(302); // リダイレクトが返されることを確認する
        $response->assertRedirect('/'); // リダイレクト先が正しいことを確認する

        // ユーザーが削除されたことを確認する
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
