<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\User;
use Livewire\Component;

class CreateChat extends Component
{
    public $user;

    public function mount($user)
    {
        $this->id = $user->id;
    }

    public function checkConversation($receiverId)
    {

        $checkedConversation = Conversation::where('receiver_id', Auth()->user()->id)->where('sender_id', $receiverId)->orWhere('receiver_id', $receiverId)->where('sender_id', Auth()->user()->id)->get();

        // すでに会話テーブルに登録されているかチャック
        if(count($checkedConversation) == 0) {

            // ユーザー間の会話を作成
            Conversation::create(['receiver_id'=>$receiverId,'sender_id'=>auth()->user()->id,'last_time_message'=>0]);

            toastr()->success('チャットリストに追加されました');
            return redirect()->to('chat');
        } else if((count($checkedConversation) >= 1)) {
            return redirect()->to('chat');
        }
    }

    public function render()
    {
        return view('livewire.chat.create-chat');
    }
}
