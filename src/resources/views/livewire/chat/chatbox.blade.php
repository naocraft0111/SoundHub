<div>
    {{-- The best athlete wants his opponent at his best. --}}

    @if ($selectedConversation)
    <div class="chatbox_header">
        <div class="return" onclick="clickEvent()" title="閉じる">
            <i class="bi bi-arrow-left"></i>
        </div>

        <div class="img_container">
            @if (isset($receiverInstance->avatar))
            <img src="{{ asset('storage/avatar/' . $receiverInstance->avatar) }}" alt="">
            @else
            <img src="{{ asset('images/user_default.png') }}">
            @endif
        </div>

        <div class="name">
            {{ $receiverInstance->name }}
        </div>

        <div class="info">
            <div class="info_item">
                <a href="{{ route('users.detail', ['name' => $receiverInstance->name])}}" title="ユーザーページ"><i class="bi bi-info-circle-fill"></i></a>
            </div>
        </div>
    </div>

    <div class="chatbox_body">
        @foreach ($messages as $message)
        <div class="msg_body {{ auth()->id() == $message->sender_id ? 'msg_body_me' : 'msg_body_receiver' }}" style="width:80%; max-width:80%; max-width:max-content;">

            {{ $message->body }}
            <div class="msg_body_footer">
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
        $('.chatbox_body').scroll(function(){
            var top = $('.chatbox_body').scrollTop();
            if(top == 0){
                window.livewire.emit('loadMore');
            }
        });
    </script>

    <script type="application/javascript">
        window.addEventListener('updatedHeight', event=>{
            let old = event.detail.height;
            let newHeight = $('.chatbox_body')[0].scrollHeight;
            let height = $('.chatbox_body').scrollTop(newHeight - old);

            window.livewire.emit('updateHeight',{
                height:height,
            });
        });
    </script>
    @else
    <div class="fs-4 text-center text-primary mt-5">
    </div>

    @endif

    <script type="application/javascript">
        window.addEventListener('rowChatToBottom', event =>{
            $('.chatbox_body').scrollTop($('.chatbox_body')[0].scrollHeight);
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
