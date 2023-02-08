@section('title', 'チャットルーム | SoundHub')
<div>

    <div class="chat_container">

        <div class="chat_list_container">
            @livewire('chat.chat-list')
        </div>
        <div class="chat_box_container">

            @livewire('chat.chatbox')

            @livewire('chat.send-message')
        </div>
    </div>

    <script type="application/javascript">
        window.addEventListener('chatSelected', event=>{
            if( window.innerWidth < 768 ){
                $('.chat_list_container').hide();
                $('.chat_box_container').show();
            }
            $('.chatbox_body').scrollTop($('.chatbox_body')[0].scrollHeight);
            let height = $('.chatbox_body')[0].scrollHeight;
            // alert(height);
            window.livewire.emit('updateHeight',{
                height:height,
            });
        });

        window.addEventListener('resize', event=>{
            if (window.innerWidth > 768) {
                $('.chat_list_container').show();
                $('.chat_box_container').show();
            }
        });

        function clickEvent() {
            $('.chat_list_container').show();
            $('.chat_box_container').toggle();
        }
    </script>
</div>
