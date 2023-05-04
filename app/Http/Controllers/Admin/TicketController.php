<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;
use App\Mail\SendTicketMail;
use App\Models\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\Models\Media;
use OneSignal;

class TicketController extends BackendController
{
    private $id;

    public function __construct()
    {
        $this->middleware(['permission:ticket'])->only('index');
        $this->middleware(['permission:ticket_create'])->only('create', 'store');
        $this->middleware(['permission:ticket_edit'])->only('edit', 'update');
        $this->middleware(['permission:ticket_destroy'])->only('destroy');
        $this->middleware(['permission:ticket_show'])->only('show', 'download', 'changeStatus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['tickets'] = Ticket::where('parent_id', 0)->latest()->get();
        return view('backend.ticket.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['parentTicket'] = Ticket::where(['parent_id' => 0])->findOrfail($id);
        $this->data['tickets']      = Ticket::where(['parent_id' => $id])->get();
        return view('backend.ticket.show', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parentTicket = Ticket::where(['parent_id' => 0])->findOrfail($request->parent_id);

        $niceNames = [];
        $this->validate($request, $this->validateArray(), [], $niceNames);

        $ticket = new Ticket;

        $ticket->name        = auth()->user()->name;
        $ticket->email       = auth()->user()->email;
        $ticket->category_id = $parentTicket->category_id;
        $ticket->subject     = $parentTicket->subject;
        $ticket->description = $request->description;
        $ticket->parent_id   = $request->parent_id;
        $ticket->creator_id  = auth()->id() ?? 0;
        $ticket->editor_id   = auth()->id() ?? 0;
        $ticket->save();

        if (!blank(request()->file('attachment'))) {
            foreach (request()->file('attachment') as $attachment) {
                $ticket->addMedia($attachment)->toMediaCollection('ticket');
            }
        }

        try {
            Mail::to($ticket->email)->send(new SendTicketMail($ticket));

            $token = $parentTicket->user->device_token;
            OneSignal::sendNotificationToUser(
                $parentTicket->subject . ' - ' . strip_tags($request->description),
                $token,
                route('frontend.myticket.show', $parentTicket)
            );

        } catch (\Exception $e) {

        }

        return redirect(route('admin.ticket.show', $parentTicket))->withSuccess('You replied ticket successfully.');
    }

    public function download($id)
    {
        $media = Media::findOrfail($id);
        return response()->download($media->getPath(), $media->file_name);
    }

    public function changeStatus(Request $request)
    {
        $ticket = Ticket::where(['parent_id' => 0])->find($request->ticketid);

        $redirectRoute = route('admin.ticket.index');
        if(isset($request->dashboard) && $request->dashboard) {
            $redirectRoute = route('admin.dashboard.index');
        }

        if (!blank($ticket)) {
            $ticket->status    = $request->status;
            $ticket->editor_id = auth()->id() ?? 0;
            $ticket->save();

            try {
                Mail::to($ticket->email)->send(new SendTicketMail($ticket));

                $token = $ticket->user->device_token;
                OneSignal::sendNotificationToUser(
                    $ticket->subject . ' - Your ticket status updated.',
                    $token,
                    route('frontend.myticket.show', $ticket)
                );
            } catch (\Exception $e) {

            }

            return redirect($redirectRoute)->withSuccess('The ticket status change successfully.');
        } else {
            return redirect($redirectRoute)->withError('The ticket status change failed.');
        }
    }

    private function validateArray()
    {
        $retArray = [
            'parent_id'   => ['required', 'numeric'],
            'description' => ['required', 'string'],
        ];

        if (!blank(request()->file('attachment'))) {
            for ($i = 0; $i < count(request()->file('attachment')); $i++) {
                $retArray['attachment.' . $i] = 'nullable|mimes:jpeg,jpg,png,gif';
            }
        }
        return $retArray;
    }

}
