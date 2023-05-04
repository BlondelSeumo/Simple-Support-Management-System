<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;
use App\Models\Message;
use App\Models\Ticket;
use App\User;

class DashboardController extends BackendController
{
    public function index()
    {
        $ticketQueryInstance = Ticket::query();
        $this->data['total_user']         = User::get()->count();
        $this->data['total_ticket']       = $ticketQueryInstance->where('parent_id', 0)->get()->count();
        $this->data['total_comment']      = $ticketQueryInstance->get('parent_id', '!=', 0)->count();
        $this->data['total_conversation'] = Message::get()->count();

        $this->data['latestTickets'] = $ticketQueryInstance->where('parent_id', 0)->latest()->take(10)->get();

        return view('backend.dashboard.index', $this->data);
    }
}
