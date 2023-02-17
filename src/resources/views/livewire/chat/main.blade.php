@section('title', 'チャット | SoundHub')
<div>
    <div class="chat-container">

        <div class="chat-list-container">
            @livewire('chat.chat-list')
        </div>
        <div class="chat-box-container">

            @livewire('chat.chatbox')

            @livewire('chat.send-message')
        </div>
    </div>

    <script type="application/javascript">
        window.addEventListener('chatSelected', event=>{
            if( window.innerWidth < 768 ){
                $('.chat-list-container').hide();
                $('.chat-box-container').show();
            }
            $('.chat-box-container__body').scrollTop($('.chat-box-container__body')[0].scrollHeight);
            let height = $('.chat-box-container__body')[0].scrollHeight;
            window.livewire.emit('updateHeight',{
                height:height,
            });
        });

        window.addEventListener('resize', event=>{
            if (window.innerWidth > 768) {
                $('.chat-list-container').show();
                $('.chat-box-container').show();
            }
        });

        function clickEvent() {
            $('.chat-list-container').show();
            $('.chat-box-container').hide();
        }
    </script>
</div>
