@extends('layout.app')

@section('sender', $sender->name)
@section('receiver', 'Conversation with '.$receiver->name)


@section('content')
<div x-data="{ scrollToBottom() { $nextTick(() => { $el.scrollTop = $el.scrollHeight }) } }"
    x-init="scrollToBottom()"
    id="message-container"
    class="overflow-y-auto h-96 p-4 bg-gray-100"
    @message-added.window="scrollToBottom">
        @foreach ($messages as $message)
            <div class="flex">
                @if ($message->sent_by == $sender->id)
                    <div class="message sent">
                        <p>{{ $message->message }}</p>
                        <span class="timestamp">{{ $message->created_at }}</span>
                    </div>
                @else
                    <div class="message received">
                        <p>{{ $message->message }}</p>
                        <span class="timestamp">{{ $message->created_at }}</span>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <form action="{{ route('chat.send', ['sender' => $sender->id, 'receiver' => $receiver->id]) }}" method="POST">
        @csrf <!-- This directive generates a CSRF token for security -->
        <div class="flex items-center mt-4">
            <input type="text" name="message" class="flex-1 border rounded-lg p-2" placeholder="Type your message here..." required>
            <button type="submit" class="ml-2 bg-blue-500 text-white rounded-lg px-4 py-2">Send</button>
        </div>
    </form>

@endsection
