<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Message;

class ChatNotifications
{
    protected $conversation;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        if(isset(Auth()->user()->id)) {
            $this->message = Message::where('read', 0)->where('receiver_id', Auth()->user()->id)->get();
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if(isset(Auth()->user()->id)) {
            $view->with('count', count($this->message));
        }
    }
}
