<?php

namespace App\Http\Livewire\Chat;

use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use App\Events\MessageSent;
use App\Events\MessageRead;
use Livewire\Component;

class Chatbox extends Component
{

    public $selectedConversation;
    public $receiver;
    public $messages;
    public $paginateVar = 10;
    public $height;
    // protected $listeners = ['loadConversation', 'pushMessage', 'loadMore', 'updateHeight'];

    public function getListeners()
    {
        $auth_id = auth()->user()->id;
        return [
            "echo-private:chat.{$auth_id},MessageSent" => 'broadcastedMessageReceived',
            "echo-private:chat.{$auth_id},MessageRead" => 'broadcastedMessageRead','loadConversation', 'pushMessage', 'loadMore', 'updateHeight', 'broadcastMessageRead', 'resetComponent'
        ];
    }

    public function resetComponent()
    {
        $this->selectedConversation = null;
        $this->receiverInstance = null;
    }

    public function broadcastedMessageRead($event){

        if($this->selectedConversation){

            if((int) $this->selectedConversation->id === (int) $event['conversation_id']){
                $this->dispatchBrowserEvent('markMessageAsRead');
            }
        }
    }

    // broadcastWith()から取得したデータを受信する
    function broadcastedMessageReceived($event)
    {
        // チャットリストを更新する
        $this->emitTo('chat.chat-list', 'refresh');

        $broadcastedMessage = Message::find($event['message']);

        // 送信されたユーザーが会話を選択しているかどうか
        if($this->selectedConversation)
        {
            // 選択された会話のターゲットと実際に送られた会話のターゲットが一致しているかどうか
            if ((int) $this->selectedConversation->id === (int)$event['conversation_id'])
            {
                // dd($event);

                $broadcastedMessage->read = 1;
                $broadcastedMessage->save();

                $this->pushMessage($broadcastedMessage->id);

                $this->emitSelf('broadcastMessageRead');
            }
        }
    }

    public function broadcastMessageRead()
    {
        broadcast(new MessageRead($this->selectedConversation->id, $this->receiverInstance->id));
    }

    // メッセージを動的に送信
    public function pushMessage($messageId)
    {
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);

        $this->dispatchBrowserEvent('rowChatToBottom');
    }

    // スクロールを上に移動した時、メッセージを読み込む
    function loadMore()
    {
        // dd('top reached');
        $this->paginateVar = $this->paginateVar + 10;
        $this->messages_count = Message::where('conversation_id', $this->selectedConversation->id)->count();

        $this->messages = Message::where('conversation_id', $this->selectedConversation->id)
                ->skip($this->messages_count - $this->paginateVar)
                ->take($this->paginateVar)
                ->get();
        $height = $this->height;
        $this->dispatchBrowserEvent('updatedHeight', ($height));
    }

    function updateHeight($height)
    {
        // dd($height);
        $this->height = $height;

    }

    public function loadConversation(Conversation $conversation, User $receiver)
    {

        // dd($conversation, $receiver);
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;

        $this->messages_count = Message::where('conversation_id', $this->selectedConversation->id)->count();

        $this->messages = Message::where('conversation_id', $this->selectedConversation->id)
                ->skip($this->messages_count - $this->paginateVar)
                ->take($this->paginateVar)
                ->get();

        $this->dispatchBrowserEvent('chatSelected');

        Message::where('conversation_id', $this->selectedConversation->id)
            ->where('receiver_id', auth()->user()->id)->update(['read' => 1]);

        $this->emitSelf('broadcastMessageRead');
    }

    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
