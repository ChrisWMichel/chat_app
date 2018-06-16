<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Illuminate\Http\Request;
use Pusher\Laravel\Facades\Pusher;

//use Vinkla\Pusher\Facades\Pusher;

class ChatController extends Controller
{
    public function userConversation(Request $request){
        $userId = $request->input('user_id');
        $auth_id = $request->input('auth_id');
/*
        $auth_email = $request->input('auth_email');
        $auth = User::where('email', $auth_email)->first();*/
        //$authUserId = $request->user()->id;

        $chats = Chat::whereIn('sender_id', [$auth_id, $userId])
          ->whereIn('receiver_id', [$auth_id, $userId])
          ->orderBy('created_at', 'asc')
          ->get();

        return response($chats->jsonSerialize());
    }

    public function addNewChat(Request $request){
        $chat = new Chat();
        $chat->sender_id = $request->sender_id;
        $chat->receiver_id = $request->receiver_id;
        $chat->chat = $request->chat;
        $chat->read = 1;
        $chat->save();

        //Pusher::trigger('chat-channel');
        Pusher::trigger('chat_channel', 'chat_saved', ['message' => $chat]);

        return response($chat->jsonSerialize());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
