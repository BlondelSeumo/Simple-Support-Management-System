@extends('_frontend_layout')

@section('content')        

    <!-- Services-->
    <section class="page-section">
        <div class="container">
            <h2 class="text-center mt-0">{{ __('frontend.my_tickets') }}</h2>
            <hr class="divider my-4" />
            @if(!blank($tickets))
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">{{ __('frontend.name') }}</th>
                            <th scope="col">{{ __('frontend.subject') }}</th>
                            <th scope="col">{{ __('frontend.category') }}</th>
                            <th scope="col">{{ __('frontend.status') }}</th>
                            <th scope="col">{{ __('frontend.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <th>{{ ++$loop->index }}</th>
                                <td>{{ $ticket->name }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ optional($ticket->category)->name }}</td>
                                <td class="text-success">{{ __('ticket_status.'. $ticket->status) }}</td>
                                <td>
                                    <a href="{{ route('frontend.myticket.show', $ticket) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="View"><i class="far fa-check-square"></i></a>
                                    <a href="{{ route('frontend.myticket.edit', $ticket) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form class="d-inline-block" action="{{ route('frontend.myticket.delete', $ticket) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else 
                <div class="text-center">
                    <h1>{{ __('frontend.oops') }}</h1>
                    <div class="text-black">
                        {{ __('frontend.does_not_any_ticket') }}
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('frontend.ticket') }}" class="btn btn-success btn-sm">
                            <span class="glyphicon glyphicon-home"></span> 
                            {{ __('frontend.create_ticket') }}
                        </a>
                        <a href="{{ route('frontend.contact') }}" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-envelope"></span> 
                            {{ __('frontend.contact_us') }}
                        </a>
                    </div>
                </div>

            @endif
        </div>
    </section>

@endsection
        