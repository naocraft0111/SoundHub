<div>
    {{-- The best athlete wants his opponent at his best. --}}

    @if ($selectedConversation)
    <div class="chatbox_header">
        <div class="return" onclick="clickEvent()">
            <i class="bi bi-arrow-left"></i>
        </div>

        <div class="img_container">
            <img src="https://picsum.photos/id/{{ $receiverInstance->id }}/200/300" alt="">
        </div>

        <div class="name">
            {{ $receiverInstance->name }}
        </div>

        <div class="info">

            <div class="info_item">
                <i class="bi bi-telephone-fill"></i>
            </div>

            <div class="info_item">
                <i class="bi bi-image"></i>
            </div>

            <div class="info_item">
                <i class="bi bi-info-circle-fill"></i>
            </div>
        </div>
    </div>

    <div class="chatbox_body">
        @foreach ($messages as $message)
        <div class="msg_body msg_body_receiver">

            {{ $message->body }}
            <div class="msg_body_footer">
                <div class="date">
                    {{ $message->created_at->format('m: i a') }}
                </div>

                <div class="read">
                    <i class="bi bi-check"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <div class="fs-4 text-center text-primary mt-5">
        no conversation selected
    </div>

    @endif

</div>
