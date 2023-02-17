<div>
    {{-- The whole world belongs to you. --}}

    @if ($selectedConversation)
        <form wire:submit.prevent='SendMessage' action="">
            <div class="chat-box-container__footer">

                <div class="custom-form-group">

                    <input wire:model='body' type="text" class="control" placeholder="メッセージを作成">
                    <button type="submit" class="submit" title="送信"><i class="bi bi-send-fill"></i></button>
                </div>

            </div>
        </form>
    @endif
</div>
