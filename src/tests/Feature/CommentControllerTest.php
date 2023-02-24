<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->article = Article::factory()->create(['user_id' => $this->user->id]);

        $this->comments = Comment::factory()->create(['article_id' => $this->article->id]);

        $this->data = ([
            'user_id' => $this->article->user_id,
            'article_id' => $this->article->id,
            'comment' => $this->comments->comment,
        ]);
    }

    /**
     * コメント投稿テスト
     */
    public function test_create()
    {
        $response = $this->actingAs($this->user)
            ->post('/comments', $this->data);

        $response->assertRedirect();
        
        $this->assertDatabaseHas('comments', [
            'user_id' => $this->article->user_id,
            'article_id' => $this->article->id,
            'comment' => $this->comments->comment
        ]);
    }

    /**
     * コメント削除テスト
     */
    public function test_delete()
    {
        $response = $this->actingAs($this->user)
            ->delete(route('comments.destroy', $this->comments->id));

        $response->assertRedirect();

        $this->assertDatabaseEmpty(Comment::class);
    }
}
