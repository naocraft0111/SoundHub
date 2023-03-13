<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewChatMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $senderName;
    public $title;
    public $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($senderName, $title, $body)
    {
        $this->senderName = $senderName;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.chat_notification')
                    ->subject($this->title)
                    ->with([
                        'senderName' => $this->senderName,
                        'title' => $this->title,
                        'body' => $this->body,
                    ]);
    }
}
