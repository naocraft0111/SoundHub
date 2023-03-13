<?php

namespace App\Http\Livewire\Chat;

use App\Events\MessageSent;
use App\Mail\NewChatMessageNotification;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class SendMessage extends Component
{

    public $selectedConversation;
    public $receiverInstance;
    public $body;
    public $createdMessage;

    protected $listeners = ['updateSendMessage', 'dispatchMessageSent', 'resetComponent'];

    public function resetComponent()
    {
        $this->selectedConversation = null;
        $this->receiverInstance = null;
    }

    function updateSendMessage(Conversation $conversation, User $receiver)
    {
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

        // メール通知
        $receiverEmail = $this->receiverInstance->email;
        $notificationTitle = auth()->user()->name .'さんから新しいメッセージが届きました';

        Mail::to($receiverEmail)
        ->send(new NewChatMessageNotification(auth()->user()->name, $notificationTitle, $this->body));

        // チャットリストを更新する
        $this->emitTo('chat.chat-list', 'refresh');
        $this->reset('body');

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
