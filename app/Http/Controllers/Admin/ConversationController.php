<?php

namespace App\Http\Controllers\Admin;

use App\Events\ConversationSent;
use App\Http\Controllers\BackendController;
use App\Models\Message;
use App\User;
use Illuminate\Http\Request;

class ConversationController extends BackendController
{
    public function index($id = 0)
    {
        $user = User::find($id);
        $this->data['chatuser'] = $user ?? json_encode(['name'=> '']);
        return view('backend.conversation.index', $this->data);
    }

    public function setConversation(Request $request)
    {
        $message = Message::create([
            'message' => $request->message,
            'user_id' => auth()->id(),
            'to_user_id' => $request->get('chat_user_id') ?? 0,
        ]);

        broadcast(new ConversationSent($message->load('user'), $this->channelID($request->get('chat_user_id'))));

        return ['status' => 'Success'];
    }

    private function channelID($chatUserId)
    {
        return $chatUserId;
    }

    public function getConversation(Request $request)
    {
        return Message::where(function ($query) use ($request) {
            $clientID = $request->get('chat_user_id');
            $query->where('user_id', $clientID)->orWhere('to_user_id', $clientID);
        })->where('group_id', 0)->with('user')->get();
    }

    public function getUser()
    {
        return User::where('id', '!=', auth()->id())->get();
    }
}
