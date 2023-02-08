<div>
    {{-- The whole world belongs to you. --}}

    @if ($selectedConversation)
        <form wire:submit.prevent='SendMessage' action="">
            <div class="chatbox_footer">

                <div class="custom_form_group">

                    <input wire:model='body' type="text" class="control" placeholder="メッセージを作成">
                    <button type="submit" class="submit">送信</button>
                </div>

            </div>
        </form>
    @endif
</div>
