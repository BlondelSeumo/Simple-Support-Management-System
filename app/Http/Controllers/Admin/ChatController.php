<?php

namespace App\Http\Controllers\Admin;

use App\Events\ConversationSent;
use App\Http\Controllers\BackendController;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends BackendController
{
    public function index()
    {
        return view('chat.index');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function store(Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message,
        ]);

        broadcast(new ConversationSent($message->load('user')))->toOthers();

        return ['status'=> 'Success'];
    }
}
