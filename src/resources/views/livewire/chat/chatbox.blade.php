<div>
    {{-- The best athlete wants his opponent at his best. --}}

    @if ($selectedConversation)
    <div class="chat-box-container__header">
        <div class="return" onclick="clickEvent()" title="閉じる">
            <i class="bi bi-arrow-left"></i>
        </div>

        <div class="chat-box-container__header__img-container">
            @if (isset($receiverInstance->avatar))
            <img src="{{ $receiverInstance->avatar }}" alt="">
            @else
            <img src="{{ asset('images/user_default.png') }}">
            @endif
        </div>

        <div class="name">
            {{ $receiverInstance->name }}
        </div>

        <div class="info">
            <div class="info-item">
                <a href="{{ route('users.detail', ['name' => $receiverInstance->name])}}" title="ユーザーページ"><i class="bi bi-info-circle-fill"></i></a>
            </div>
        </div>
    </div>

    <div class="chat-box-container__body">
        @foreach ($messages as $message)
        <div class="msg-body {{ auth()->id() == $message->sender_id ? 'msg-body-me' : 'msg-body-receiver' }}" style="width:80%; max-width:80%; max-width:max-content;">

            {{ $message->body }}
            <div class="msg-body__footer">
                <div class="date">
                    {{ $message->created_at->format('Y/m/d G:i') }}
                </div>

                <div class="read">
                    @php

                    if($message->user->id === auth()->id()){

                        if($message->read == 0){
                            echo '<i class="bi bi-check2 status_tick"></i>';
                        }
                        else {
                            echo '<i class="bi bi-check2-all text-primary"></i>';
                        }
                    }

                    @endphp
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script type="application/javascript">
        $('.chat-box-container__body').scroll(function(){
            var top = $('.chat-box-container__body').scrollTop();
            if(top == 0){
                window.livewire.emit('loadMore');
            }
        });
    </script>

    <script type="application/javascript">
        window.addEventListener('updatedHeight', event=>{
            let old = event.detail.height;
            let newHeight = $('.chat-box-container__body')[0].scrollHeight;
            let height = $('.chat-box-container__body').scrollTop(newHeight - old);

            window.livewire.emit('updateHeight',{
                height:height,
            });
        });
    </script>
    @else

    @endif

    <script type="application/javascript">
        window.addEventListener('rowChatToBottom', event =>{
            $('.chat-box-container__body').scrollTop($('.chat-box-container__body')[0].scrollHeight);
        });
    </script>

    <script type="application/javascript">
        document.addEventListener('click', function(e) {
            if(e.target.className === 'return') {
                window.livewire.emit('resetComponent');
            }
        }, false);
    </script>

    <script type="application/javascript">
        window.addEventListener('markMessageAsRead', event=>{
            var value = document.querySelectorAll('.status_tick');

            value.array?.forEach(element, index => {
                element.classList.remove('bi bi-check2');
                elememt.classList.add('bi bi-check2-all', 'text-primary');
            });
        });
    </script>
</div>
