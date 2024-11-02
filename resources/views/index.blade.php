@extends('layout.app')

@section('title', 'All Users')


@section('content')

    <nav class ="mb-4">
        <a href="#" class="link">Add task</a>
    </nav>
     {{-- @if(count($tasks)) --}}
        @forelse ( $users as  $user)
            <div class="mb-2">
                <a href="{{ route('chat.profile', ['user' => $user->id] ) }}">{{$user->name}}</a>
            </div>
        @empty
            <div>No users</div>
        @endforelse

    {{-- @endif --}}

        @if ($users->count())
            <nav class="mt-4">
                {{$users->links()}}
            </nav>
        @endif
@endsection
