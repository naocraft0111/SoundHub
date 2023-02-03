@extends('layouts.app')

@section('title', 'チャットルーム | SoundHub')

@section('content')
<div class="chat_container">
    {{-- <h3 class="text-center">チャットルーム</h3> --}}

    <div class="chat_list_container">
        @livewire('chat.chat-list')
    </div>
    <div class="chat_box_container">

        @livewire('chat.chatbox')

        @livewire('chat.send-message')
    </div>
</div>
@endsection
