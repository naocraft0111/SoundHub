<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $email;
    private $title;
    private $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->name = $inputs['name'];
        $this->email = $inputs['email'];
        $this->title = $inputs['title'];
        $this->body = $inputs['body'];
    }

    public function build()
    {
        return $this
            ->from('
            soundhub1110@gmail.com')
            ->subject('お問い合わせ頂いた内容に関して')
            ->view('contact.mail')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'title' => $this->title,
                'body' => $this->body,
            ]);
    }
}
