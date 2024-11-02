@extends('layout.app')

@section('title', $user->name)


@section('content')

     {{-- @if(count($tasks)) --}}
        @forelse ( $allUsers as  $recipient)
            @if ($user->name != $recipient->name)
                <div class="mb-2">
                    <a href="{{ route('chat.conversation', ['sender' => $user->id, 'receiver' => $recipient->id]) }}">{{$recipient->name}}</a>
                </div>
            @endif
        @empty
            <div>No users</div>
        @endforelse

    {{-- @endif --}}

        @if ($allUsers->count())
            <nav class="mt-4">
                {{$allUsers->links()}}
            </nav>
        @endif
@endsection
