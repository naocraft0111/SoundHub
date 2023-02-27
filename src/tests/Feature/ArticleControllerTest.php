<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->article = Article::factory()->create(['user_id' => $this->user->id]);

        $this->data = ([
            'user_id' => $this->article->user_id,
            'title' => $this->article->title,
            'body' => $this->article->body,
        ]);
    }

    /**
     * 投稿トップ画面表示テスト
     */
    public function test_index()
    {
        $response = $this->actingAs($this->user)
            ->get('/articles');

        $response->assertStatus(200);
    }

    /**
     * 新規投稿テスト
     */
    public function test_create()
    {
        $response = $this->actingAs($this->user)
            ->get('/articles/create');

        $response->assertStatus(200);
    }

    /**
     * 記事保存処理テスト
     */
    public function test_store()
    {
        $response = $this->actingAs($this->user)
            ->post('/articles', $this->data);
        $response->assertRedirect('/articles');
        $this->assertDatabaseHas('articles', [
            'user_id' => $this->article->user_id,
            'title' => $this->article->title,
            'body' => $this->article->body,
        ]);
    }

    /**
     * 記事更新処理テスト
     */
    public function test_update()
    {
        $response = $this->actingAs($this->article->user)
            ->from(route('articles.edit', ['article' => $this->article->id]))
            ->put(
                route('articles.update', ['article' => $this->article->id]),
                [
                    'user_id' => $this->article->user_id,
                    'title' => 'testTitle',
                    'body' => 'testBody',
                ]
                );
            $response->assertRedirect('/articles');
            $this->assertDatabaseHas('articles', [
                'title' => 'testTitle',
                'body' => 'testBody',
            ]);
    }

    /**
     * 記事削除テスト
     */
    public function test_destroy()
    {
        $response = $this->actingAs($this->article->user)
            ->delete('/articles/' . $this->article->id);
        $response->assertRedirect('/articles');
        $this->assertDatabaseMissing('articles', $this->data)
            ->assertEquals(0, Article::count());
    }

    /**
     * いいね判定テスト(nullの場合)
     */
    public function test_IsLikedByNull()
    {
        $article = Article::factory()->create();

        $result = $article->isLikedBy(null);

        $this->assertFalse($result);
    }


    /**
     * いいね判定テスト(いいねしている場合)
     */
    public function test_IsLikedByTheUser()
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();

        $article->likes()->attach($user);

        $result = $article->isLikedBy($user);

        $this->assertTrue($result);
    }

    /**
     * いいね判定テスト(いいねしていない場合)
     */
    public function test_IsLikedByAnother()
    {
        $article = Article::factory()->create();
        $user = User::factory()->create();
        $another = User::factory()->create();
        $article->likes()->attach($another);

        $result = $article->isLikedBy($user);

        $this->assertFalse($result);
    }
}
