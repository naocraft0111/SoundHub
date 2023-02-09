<?php

namespace App\Http\Livewire\Chat;

use App\Events\MessageSent;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SendMessage extends Component
{

    public $selectedConversation;
    public $receiverInstance;
    public $body;
    public $createdMessage;

    protected $listeners = ['updateSendMessage', 'dispatchMessageSent'];

    function updateSendMessage(Conversation $conversation, User $receiver)
    {
        // dd($conversation, $receiver);
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;
    }

    public function SendMessage()
    {
        if($this->body == null){
            return null;
        }


        $this->createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'body' => $this->body,
        ]);

        $this->selectedConversation->last_time_message = $this->createdMessage->created_at;
        $this->selectedConversation->save();

        $this->emitTo('chat.chatbox', 'pushMessage', $this->createdMessage->id);

        // チャットリストを更新する
        $this->emitTo('chat.chat-list', 'refresh');
        $this->reset('body');

        // イベントが発生した時だけ発火
        $this->emitSelf('dispatchMessageSent');
        // dd($this->body);
    }

    // イベントにメッセージ情報を送信する
    public function dispatchMessageSent()
    {
        broadcast(new MessageSent(Auth()->user(), $this->createdMessage, $this->selectedConversation, $this->receiverInstance));
    }

    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
