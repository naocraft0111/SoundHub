<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\User;
use App\Models\Message;
use Livewire\Component;

class CreateChat extends Component
{
    public $users;
    public $message = 'hello how are you';

    public function checkConversation($receiverId)
    {
        // dd($receiverId);

        $checkedConversation = Conversation::where('receiver_id', Auth()->user()->id)->where('sender_id', $receiverId)->orWhere('receiver_id', $receiverId)->where('sender_id', Auth()->user()->id)->get();

        // すでに会話テーブルに登録されているかチャック
        if(count($checkedConversation) == 0) {
            // dd('no conversation');

            // ユーザー間の会話を作成
            $createdConversation= Conversation::create(['receiver_id'=>$receiverId,'sender_id'=>auth()->user()->id,'last_time_message'=>0]);

            // 会話idを取得することでメッセージを作成
            $createdMessage = Message::create(['conversation_id' => $createdConversation->id, 'sender_id' => auth()->user()->id, 'receiver_id' => $receiverId, 'body' => $this->message]);

            // DB保存
            $createdConversation->last_time_message = $createdMessage->created_at;
            $createdConversation->save();

            dd($createdMessage);
            dd('saved');
        } else if((count($checkedConversation) >= 1)) {
            dd('conversation exists');
        }
    }

    public function render()
    {
        $this->users = User::where('id', '!=', auth()->user()->id)->get();
        return view('livewire.chat.create-chat')->extends('layouts.app')->section('content');
    }
}
