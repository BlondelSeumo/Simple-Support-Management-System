<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use App\Mail\SendTicketMail;
use App\Models\Category;
use App\Models\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use OneSignal;
use Spatie\Permission\Models\Role;

class TicketController extends FrontendController
{
    public function index()
    {
        $this->data['categories'] = Category::all();
        return view('frontend.ticket.index', $this->data);
    }

    public function store(Request $request)
    {
        $niceNames = [];
        $this->validate($request, $this->validateArray(), [], $niceNames);

        $ticket = new Ticket;

        $ticket->name        = $request->name;
        $ticket->email       = $request->email;
        $ticket->category_id = $request->category_id;
        $ticket->subject     = $request->subject;
        $ticket->description = $request->description;
        $ticket->creator_id  = auth()->id() ?? 0;
        $ticket->editor_id   = auth()->id() ?? 0;
        $ticket->save();

        if (!blank(request()->file('attachment'))) {
            foreach (request()->file('attachment') as $attachment) {
                $ticket->addMedia($attachment)->toMediaCollection('ticket');
            }
        }

        try {
            $roles  = Role::whereIn('id', [1, 2])->get()->pluck('name');
            $users  = User::role($roles)->get();
            $emails = $users->pluck('email');
            $tokens = $users->pluck('device_token')->toArray();

            Mail::to($emails)->send(new SendTicketMail($ticket));

            OneSignal::sendNotificationToUser(
                $request->subject . ' - ' . strip_tags($request->description),
                $tokens,
                route('admin.ticket.show', $ticket)
            );
        } catch (\Exception $e) {

        }

        return redirect(route('frontend.ticket'))->withSuccess('You created ticket successfully.');
    }

    private function validateArray(): array
    {
        $retArray = [
            'name' => ['required', 'string', 'max:60'],
            'email' => ['required', 'string', 'max:60', 'email'],
            'category_id' => ['required', 'string', 'max:60'],
            'subject' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
        ];

        if (!blank(request()->file('attachment'))) {
            for ($i = 0; $i < count(request()->file('attachment')); $i++) {
                $retArray['attachment.' . $i] = 'nullable|mimes:jpeg,jpg,png,gif,pdf,docx';
            }
        }
        return $retArray;
    }
}
