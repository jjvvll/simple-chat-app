<?php

use Illuminate\Support\Facades\Route;
use \App\Models\ChatUser;


Route::get('/users', function ()  {

    return view('index', [
       'users' => ChatUser::latest()->paginate(10)
    ]);
})->name('chat.index');


Route::get('/users/{user}', function (ChatUser $user) {
    // Fetch all users from the database
    $allUsers = ChatUser::latest()->paginate(10);

    // Pass both the specific user and all users to the view
    return view('profile', [
        'user' => $user,
        'allUsers' => $allUsers
    ]);
})->name('chat.profile');


Route::get('/conversations/{sender}/{receiver}', function ($sender, $receiver) {
    // Fetch messages between the sender and receiver
    $messages = \App\Models\Conversation::where(function($query) use ($sender, $receiver) {
        $query->where('sent_by', $sender)
              ->where('received_by', $receiver);
    })->orWhere(function($query) use ($sender, $receiver) {
        $query->where('sent_by', $receiver)
              ->where('received_by', $sender);
    })->orderBy('created_at')->get();

    // Fetch sender and receiver names using the User model
    $senderUser = ChatUser::find($sender);
    $receiverUser = ChatUser::find($receiver);

    return view('chat', [
        'messages' => $messages,
        'sender' => $senderUser, // Pass the entire user object
        'receiver' => $receiverUser // Pass the entire user object
    ]);
})->name('chat.conversation');

Route::post('/send-message/{sender}/{receiver}', function ($sender, $receiver) {

    $data = request()->validate([
        'message' => 'required|string',
    ]);

    \App\Models\Conversation::create([
        'sent_by' => $sender,
        'received_by' => $receiver,
        'message' => $data['message'],
    ]);

    return redirect()->route('chat.conversation', ['sender' => $sender, 'receiver' => $receiver]);
})->name('chat.send');
