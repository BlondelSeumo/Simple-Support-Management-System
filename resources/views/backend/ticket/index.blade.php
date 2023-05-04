@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-fw fa-ticket-alt"></i> {{ __('ticket.ticket') }}</h1>

            <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <a class="text-white"><i class="fas fa-ticket-alt fa-sm text-white-50"></i> {{ __('ticket.ticket') }}</a>
            </span>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card shadow mb-4">
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
                                    @if(!blank($tickets))
                                        @foreach($tickets as $ticket)
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
                                    @endif
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
            </div>
        </div>
    </div>
    <div class="modal fade" id="ChangeStatus">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.ticket.changestatus') }}">
                    @csrf
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

    <!-- /.container-fluid -->
@endsection

@push('header_css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('footer_scripts')
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush