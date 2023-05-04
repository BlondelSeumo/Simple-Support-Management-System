<?php

namespace App\Http\Controllers\Frontend;

use App\Events\ConversationSent;
use App\Http\Controllers\FrontendController;
use App\Models\Message;
use Illuminate\Http\Request;

class LiveChatController extends FrontendController
{
    public function index()
    {
        $this->data['chatuser'] = json_encode(['name' => 'Support Team']);
        return view('frontend.livechat.index', $this->data);
    }

    public function setLiveChat(Request $request)
    {
        $message = Message::create([
            'message' => $request->conversation,
            'user_id' => auth()->id(),
            'to_user_id' => 0,
            'group_id' => 0,
        ]);

        broadcast(new ConversationSent($message->load('user'), $this->channelID()));

        return ['status' => 'Success'];
    }

    public function getLiveChat(Request $request)
    {
        return Message::where(function ($query) {
            $clientID = auth()->id();
            $query->where('user_id', $clientID)->orWhere('to_user_id', $clientID);
        })->where('group_id', 0)->with('user')->get();
    }

    private function channelID()
    {
        return auth()->id();
    }
}
