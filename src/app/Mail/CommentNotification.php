<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Comment;

class CommentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $recipient;
    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, User $recipient, Comment $comment)
    {
        $this->user = $user;
        $this->recipient = $recipient;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->user->name .'さんからコメントが投稿されました')
                    ->view('emails.comment_notification');
    }
}
