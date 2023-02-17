<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="chat-list-container__header">

        <div class="title">
            チャット
        </div>

        <div class="chat-list-container__header__img-container">
            @if (isset(Auth()->user()->avatar))
            <img src="{{ asset('storage/avatar/' . Auth()->user()->avatar) }}" alt="">
            @else
            <img src="{{ asset('images/user_default.png') }}">
            @endif
        </div>
    </div>

    <div class="chat-list-container__body">
            @if (count($conversations) > 0)
            @foreach ($conversations as $conversation)
            <div class="chat-list-container__body__item" wire:key='{{$conversation->id}}' wire:click="$emit('chatUserSelected', {{$conversation}},{{$this->getChatUserInstance($conversation, $name = 'id') }})">
                <div class="chat-list-container__body__item__img-container">
                    @if (null ==($this->getChatUserInstance($conversation, $name = 'avatar')))
                    <img src="{{ asset('images/user_default.png') }}">
                    @else
                    <img src="{{ asset('storage/avatar/' . $this->getChatUserInstance($conversation, $name = 'avatar')) }}" alt="">
                    @endif
                </div>
                <div class="chat-list-container__body__item__info">
                    <div class="top-row">
                        <div class="list-username">{{ $this->getChatUserInstance($conversation, $name='name') }}</div>
                        <span class="date">{{$conversation->messages->last()->created_at->shortAbsoluteDiffForHumans()}}</span>
                    </div>

                    <div class="bottom-row">

                        <div class="message-body text-truncate">
                            {{$conversation->messages->last()->body}}
                        </div>
                        @php
                            if(count($conversation->messages->where('read',0)->where('receiver_id', Auth()->user()->id))){
                                echo '<div class="unread-count badge rounded-pill text-light bg-danger">' . count($conversation->messages->where('read',0)->where('receiver_id', Auth()->user()->id)) .'</div>';
                            }
                        @endphp
                    </div>
                </div>
            </div>
            @endforeach

            @else
            <div class="fs-4 text-center text-primary mt-5">
                チャットへようこそ
            </div>
            @endif
    </div>
</div>
