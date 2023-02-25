<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Http\Livewire\Chat\CreateChat;
use App\Models\Conversation;
use App\Models\Message;
use Livewire\Livewire;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * 会話の作成
     */
    public function test_creates_conversation_and_redirects_to_chat()
    {
        // テスト用の2つのユーザーを作成
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // ユーザー1でログイン
        $this->actingAs($user1);

        // Livewireコンポーネントをマウント
        Livewire::test(CreateChat::class, ['user' => $user2])
            ->set('message', 'はじめまして')
            ->call('checkConversation', $user2->id)
            ->assertRedirect('chat');

        // データベースに会話とメッセージが作成されたことを確認
        $this->assertCount(1, Conversation::all());
        $this->assertCount(1, Message::all());
    }

    /**
     * すでに会話がある場合
     */
    public function test_redirects_to_chat_if_conversation_already_exists()
    {
        // テスト用の2つのユーザーを作成
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // ユーザー1でログイン
        $this->actingAs($user1);

        // すでに会話が存在する場合の挙動をテスト
        Conversation::create(['sender_id' => $user1->id, 'receiver_id' => $user2->id]);

        // Livewireコンポーネントをマウント
        Livewire::test(CreateChat::class, ['user' => $user2])
            ->set('message', 'はじめまして')
            ->call('checkConversation', $user2->id)
            ->assertRedirect('chat');

        // データベースに会話とメッセージが作成されていないことを確認
        $this->assertCount(1, Conversation::all());
        $this->assertCount(0, Message::all());
    }
}
