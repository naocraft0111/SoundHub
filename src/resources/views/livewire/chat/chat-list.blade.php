<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="chatlist_header">

        <div class="title">
            メッセージ
        </div>

        <div class="img_container">
            @if (isset(Auth()->user()->avatar))
            <img src="{{ asset('storage/avatar/' . Auth()->user()->avatar) }}" alt="">
            @else
            <img src="{{ asset('images/user_default.png') }}">
            @endif
        </div>
    </div>

    <div class="chatlist_body">
            @if (count($conversations) > 0)
            @foreach ($conversations as $conversation)
            <div class="chatlist_item" wire:key='{{$conversation->id}}' wire:click="$emit('chatUserSelected', {{$conversation}},{{$this->getChatUserInstance($conversation, $name = 'id') }})">
                <div class="chatlist_img_container">
                    @if (null ==($this->getChatUserInstance($conversation, $name = 'avatar')))
                    <img src="{{ asset('images/user_default.png') }}">
                    @else
                    <img src="{{ asset('storage/avatar/' . $this->getChatUserInstance($conversation, $name = 'avatar')) }}" alt="">
                    @endif
                </div>
                <div class="chatlist_info">
                    <div class="top_row">
                        <div class="list_username">{{ $this->getChatUserInstance($conversation, $name='name') }}</div>
                        <span class="date">{{$conversation->messages->last()->created_at->shortAbsoluteDiffForHumans()}}</span>
                    </div>

                    <div class="bottom_row">

                        <div class="message_body text-truncate">
                            {{$conversation->messages->last()->body}}
                        </div>
                        @php
                            if(count($conversation->messages->where('read',0)->where('receiver_id', Auth()->user()->id))){
                                echo '<div class="unread_count badge rounded-pill text-light bg-danger">' . count($conversation->messages->where('read',0)->where('receiver_id', Auth()->user()->id)) .'</div>';
                            }
                        @endphp
                    </div>
                </div>
            </div>
            @endforeach

            @else
            メッセージへようこそ
            @endif
    </div>
</div>
