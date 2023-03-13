<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class FollowNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $follower;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, User $follower)
    {
        $this->user = $user;
        $this->follower = $follower;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.follow_notification')
                    ->subject($this->user->name .'さんにフォローされました')
                    ->with([
                        'user' => $this->user,
                        'follower' => $this->follower,
                    ]);
    }
}
