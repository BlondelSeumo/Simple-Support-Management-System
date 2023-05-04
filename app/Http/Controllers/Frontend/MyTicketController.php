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
use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Models\Role;

class MyTicketController extends FrontendController
{
    public function index()
    {
        $this->data['tickets'] = Ticket::where(['creator_id' => auth()->id(), 'parent_id' => 0])->get();
        return view('frontend.myticket.index', $this->data);
    }

    public function store(Request $request)
    {
        $parentTicket = Ticket::where(['creator_id' => auth()->id(), 'parent_id' => 0])->findOrfail($request->parent_id);

        $niceNames = [];
        $this->validate($request, $this->validateArray(), [], $niceNames);

        $ticket = new Ticket;

        $ticket->name = auth()->user()->name;
        $ticket->email = auth()->user()->email;
        $ticket->category_id = $parentTicket->category_id;
        $ticket->subject = $parentTicket->subject;
        $ticket->description = $request->description;
        $ticket->parent_id = $request->parent_id;
        $ticket->creator_id = auth()->id() ?? 0;
        $ticket->editor_id = auth()->id() ?? 0;
        $ticket->save();

        if (!blank(request()->file('attachment'))) {
            foreach (request()->file('attachment') as $attachment) {
                $ticket->addMedia($attachment)->toMediaCollection('ticket');
            }
        }

        try {
            $roles = Role::whereIn('id', [1, 2])->get()->pluck('name');
            $users = User::role($roles)->get();
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

        return redirect(route('frontend.myticket.show', $parentTicket))->withSuccess('You replied ticket successfully.');
    }

    public function edit($id)
    {
        $this->data['ticket'] = Ticket::where(['creator_id' => auth()->id(), 'parent_id' => 0])->findOrfail($id);
        $this->data['categories'] = Category::all();
        return view('frontend.myticket.edit', $this->data);
    }

    public function show($id)
    {
        $this->data['parentTicket'] = Ticket::where(['creator_id' => auth()->id(), 'parent_id' => 0])->findOrfail($id);
        $this->data['tickets'] = Ticket::where(['parent_id' => $id])->get();
        return view('frontend.myticket.show', $this->data);
    }

    public function update(Request $request, $id)
    {
        $niceNames = [];
        $this->validate($request, $this->validateUpdateArray(), [], $niceNames);

        $ticket = Ticket::where(['creator_id' => auth()->id(), 'parent_id' => 0])->findOrfail($id);

        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->category_id = $request->category_id;
        $ticket->subject = $request->subject;
        $ticket->description = $request->description;
        $ticket->creator_id = auth()->id() ?? 0;
        $ticket->editor_id = auth()->id() ?? 0;
        $ticket->save();

        $ticket->media()->delete();

        if (!blank(request()->file('attachment'))) {
            foreach (request()->file('attachment') as $attachment) {
                $ticket->addMedia($attachment)->toMediaCollection('ticket');
            }
        }

        try {
            $roles = Role::whereIn('id', [1, 2])->get()->pluck('name');
            $users = User::role($roles)->get();
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

        return redirect(route('frontend.myticket.index'))->withSuccess('You ticket updated successfully.');
    }

    public function delete($id)
    {
        $ticket = Ticket::where(['creator_id' => auth()->id(), 'parent_id' => 0])->findOrfail($id);
        $ticket->delete();
        return redirect(route('frontend.myticket.index'))->withSuccess('Your ticket deleted successfully');
    }

    public function download($id)
    {
        $media = Media::findOrfail($id);
        return response()->download($media->getPath(), $media->file_name);
    }

    private function validateArray(): array
    {
        $retArray = [
            'parent_id' => ['required', 'numeric'],
            'description' => ['required', 'string'],
        ];

        if (!blank(request()->file('attachment'))) {
            for ($i = 0; $i < count(request()->file('attachment')); $i++) {
                $retArray['attachment.' . $i] = 'nullable|mimes:jpeg,jpg,png,gif,pdf,docx';
            }
        }
        return $retArray;
    }

    private function validateUpdateArray(): array
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
