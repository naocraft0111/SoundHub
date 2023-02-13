@section('title', 'チャットユーザー | SoundHub')
<div>
    <div class="border rounded-circle me-3 message-icon" wire:click="checkConversation({{$user->id}})">
        <i class="fa fa-envelope m-2 "style="font-size: 17px;"></i>
    </div>
</div>
