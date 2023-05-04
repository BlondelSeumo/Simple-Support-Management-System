@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> <i class="fa fa-tachometer-alt"></i> {{ __('global.dashboard') }}</h1>
        </div>

        <!-- Content Row -->
        <div class="card py-2">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-xl-12 col-md-12">
                        <h1 class="mb-0">{{ __('dashboard.welcome_to') }} <span class="text-primary">{{ setting('site_name') }}</span></h1>
                        <hr>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="dashboard-ticket col-sm-3 text-center">
                        <h4 class="item-title"><a href="{{ route('admin.ticket.index') }}">{{ __('dashboard.total_ticket') }}</a></h4>
                        <p class="item-figure text-success">{{ $total_ticket }}</p>
                    </div>

                    <div class="dashboard-ticket col-sm-3 text-center">
                        <h4 class="item-title"><a href="{{ route('admin.ticket.index') }}">{{ __('dashboard.total_comment') }}</a></h4>
                        <p class="item-figure text-danger">{{ $total_comment }}</p>
                    </div>

                    <div class="dashboard-ticket col-sm-3 text-center">
                        <h4 class="item-title"><a href="{{ route('admin.user.index') }}">{{ __('dashboard.total_user') }}</a></h4>
                        <p class="item-figure text-info">{{ $total_user }}</p>
                    </div>

                    <div class="dashboard-ticket col-sm-3 text-center">
                        <h4 class="item-title"><a href="{{ route('admin.conversation.index') }}">{{ __('dashboard.total_message') }}</a></h4>
                        <p class="item-figure text-purple">{{ $total_conversation }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if(!blank($latestTickets))
            <div class="card shadow my-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Subject') }}</th>
                                <th>{{ __('ticket.category') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Date') }}</th>
                                @if(auth()->user()->can('ticket_show') || auth()->user()->can('ticket_edit'))
                                    <th>{{ __('Action') }}</th>
                                    @endif
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($latestTickets as $ticket)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $ticket->name }}</td>
                                        <td>{{ $ticket->subject }}</td>
                                        <td>{{ optional($ticket->category)->name }}</td>
                                        <td class="text-success">{{ __('ticket_status.'. $ticket->status) }}</td>
                                        <td>{{ $ticket->created_at->format('d M Y, h:i A') }}</td>
                                        @if(auth()->user()->can('ticket_show') || auth()->user()->can('ticket_edit'))
                                            <td>
                                                @if(auth()->user()->can('ticket_show'))
                                                    <a href="{{ route('admin.ticket.show', $ticket) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="View"><i class="far fa-check-square"></i></a>
                                                @endif

                                                @if(auth()->user()->can('ticket_edit'))
                                                    <span data-toggle="tooltip" data-placement="top" title="Change Status">
                                                                    <button data-ticketid="{{ $ticket->id }}" data-statusid="{{ $ticket->status }}" type="button" class="btn btn-danger btn-sm ChangeStatusButton" data-toggle="modal" data-target="#ChangeStatus"><i class="fas fa-calendar-check"></i></button>
                                                                </span>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Subject') }}</th>
                                <th>{{ __('ticket.category') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Date') }}</th>
                                @if(auth()->user()->can('ticket_show') || auth()->user()->can('ticket_edit'))
                                    <th>{{ __('Action') }}</th>
                                @endif
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ChangeStatus">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('admin.ticket.changestatus') }}">
                            @csrf
                            <input type="hidden" name="dashboard" value="true">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('Change Status') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="ticketid" id="ticketid">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">{{ __('Status') }}</label>
                                    <select name="status" id="ticketStatus" class="form-control">
                                        <option value="0">{{ __('Select Status') }}</option>
                                        @if(!blank(trans('ticket_status')))
                                            @foreach(trans('ticket_status') as $statusKey => $status)
                                                <option value="{{ $statusKey }}">{{ $status }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                <button type="submit" class="btn btn-primary">{{ __('Change Status') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- /.container-fluid -->
@endsection
