<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $loginUrl = 'login';

    /**
     * ログイン画面が開けるかチェック
     */
    public function test_ShowLoginForm() {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    /**
     * ログイン時にバリデーションチェック
     */
    public function test_Validation()
    {
        $this->from($this->loginUrl)
            ->post($this->loginUrl, [
                'email' => '',
                'password' => '',
            ])
            ->assertSessionHasErrors([
                'email' => 'メールアドレスは必須項目です。',
                'password' => 'パスワードは必須項目です。',
            ])
            ->assertRedirect($this->loginUrl);

        // DBに登録されていないメールアドレスとパスワードを入力してログインしようとすると、バリデーションエラーが発生することをテストする
        $dbData = [
            'email' => 'aaa@example.com',
            'password' => 'Test4321',
        ];

        User::factory()->create($dbData);
        $postDataSet = [
            [
                'email' => 'bbb@example.com', // メールアドレスが間違っている
                'password' => 'Test4321',
            ],
            [
                'email' => 'aaa@example.com',
                'password' => 'Test1234', // パスワードが間違っている
            ],
            [
                // メールアドレスとパスワード両方が間違っている
                'email' => 'bbb@example.com',
                'password' => 'Test1234',
            ],
        ];

        foreach ($postDataSet as $postData) {
            $this->from($this->loginUrl)
                ->followingRedirects()
                ->post($this->loginUrl, $postData)
                ->assertSee('認証に失敗しました。');
        }
    }

    /**
     * ログインテスト
     */
    public function test_Login()
    {
        $postData = [
            'email' => 'aaa@example.com',
            'password' => 'Test4321',
        ];

        $dbData = [
            'email' => 'aaa@example.com',
            'password' => Hash::make('Test4321'),
        ];

        $user = User::factory()->create($dbData);

        // ログインに成功したら、ホーム画面に遷移する
        $this->post($this->loginUrl, $postData)
            ->assertRedirect(RouteServiceProvider::HOME);

        // 指定したユーザーが認証されているかチェック
        $this->assertAuthenticatedAs($user);

        // ログイン後にログイン画面にアクセスしようとすると、ホーム画面にリダイレクトされるかチェック
        $this->get($this->loginUrl)
            ->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * ゲストログインテスト
     */
    public function test_GuestLogin()
    {
        // ゲストログイン用のユーザーを作成
        User::factory()->create([
            'id' => config('user.guest_user.id'),
            'name' => config('user.guest_user.name'),
            'email' => config('user.guest_user.email'),
            'password' => Hash::make(config('user.guest_user.password'))
        ]);

        // ゲストログインに成功したら、ホーム画面に遷移するかチェック
        $this->get(route('login.guest'))
            ->assertRedirect(RouteServiceProvider::HOME);

        // ログイン後にログイン画面にアクセスするとき。ホーム画面にリダイレクトされるかチェック
        $this->get($this->loginUrl)
            ->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * ログアウト処理テスト
     */
    public function test_Logout()
    {
        $this->get($this->loginUrl);

        $this->post(route('logout'))
            ->assertRedirect('/');

        $this->assertGuest();
    }

}
