<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Mail\ContactSendmail;
use Illuminate\Support\Facades\Mail;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->inputs = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'title' => $this->faker->realText(250),
            'body' => $this->faker->realText(50),
            'agree' => $this->faker->boolean,
            'agree.*' => $this->faker->boolean,
        ];
    }

    /**
     * お問い合わせページ表示確認
     */
    public function test_show()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
    }

    /**
     * お問い合わせメール送信テスト
     */
    public function test_send()
    {
        Mail::fake();

        Mail::assertNothingSent();

        $response = $this->post(route('contact.send'), $this->inputs);

        // 送信されたメールを検証する(自分自身に返信)
        Mail::assertSent(ContactSendmail::class, function ($mail) {
            return $mail->From('soundhub1110@gmail.com');
        });

        // メールが一回送信されたことをアサート
        Mail::assertSent(ContactSendMail::class, 1);
    }

}
