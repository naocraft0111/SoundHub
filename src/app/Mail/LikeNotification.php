<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Article;

class LikeNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $article;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Article $article)
    {
        $this->user = $user;
        $this->article = $article;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.like_notification')
                    ->subject($this->user->name .'さんからいいねが送信されました')
                    ->with([
                        'user' => $this->user,
                        'article' => $this->article,
                    ]);
    }
}
