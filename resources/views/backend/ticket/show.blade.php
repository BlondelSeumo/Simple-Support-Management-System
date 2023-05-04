@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-ticket-alt"></i> {{ __('ticket.ticket') }}</h1>

            <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <a href="{{ route('admin.ticket.index') }}" class="text-white"><i class="fas fa-ticket-alt fa-sm text-white-50"></i> {{ __('ticket.ticket') }}</a> / 
                <a class="text-white">{{ __('View') }}</a>
            </span>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h2 class="text-center mt-0">{{ __('Your Ticket') }}</h2>
                        <span class="text-center mt-0 d-block">{{ $parentTicket->created_at->format('d F Y, h:i A') }}</span>
                        <hr class="divider my-4" />
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="timeline">
                                    <li>
                                        <fieldset class="timeline-fieldset">
                                            <legend class="timeline-legend">{{ $parentTicket->name }}</legend>
                                            <a class="text-primary">{{ $parentTicket->subject }}</a>
                                            <a class="float-right text-primary">{{ $parentTicket->created_at->format('d F Y, h:i A') }}</a>
                                            <?=clean($parentTicket->description, 'default')?>


                                            @if(!blank($parentTicket->getMedia('ticket')))
                                                @foreach($parentTicket->getMedia('ticket') as $mediaticket)
                                                    <a href="{{ route('admin.ticket.download', $mediaticket) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ $mediaticket->file_name }}">{{ __('Download') }}</a>
                                                @endforeach
                                            @endif
                                        </fieldset>
                                    </li>
                                    
                                    @if(!blank($tickets))
                                        @foreach($tickets as $ticket)
                                            <li>
                                                <fieldset class="timeline-fieldset {{ $ticket->creator_id == auth()->id() ? 'myticket' : ''}}">
                                                    <legend class="timeline-legend">
                                                        @if($ticket->creator_id == auth()->id())
                                                            {{ __('You') }}
                                                        @else
                                                            {{ optional($ticket->user)->name }}
                                                        @endif
                                                    </legend>
                                                    <a class="text-primary">{{ $ticket->subject }}</a>
                                                    <a class="float-right text-primary">{{ $ticket->created_at->format('d F Y, h:i A') }}</a>
                                                    <?=clean($ticket->description, 'default')?>
                                                    @if(!blank($ticket->getMedia('ticket')))
                                                        @foreach($ticket->getMedia('ticket') as $mediaticket)
                                                            <a href="{{ route('admin.ticket.download', $mediaticket) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ $mediaticket->file_name }}">{{ __('Download') }}</a>
                                                        @endforeach
                                                    @endif
                                                </fieldset>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <hr class="divider my-4" />
                        <form method="POST" action="{{ route('admin.ticket.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $parentTicket->id }}" name="parent_id">
                            <div class="row">
                                <div class="col-sm-8 offset-lg-2">
                                    <div class="form-group @error('description') ticket-error @enderror">
                                        <label for="description">{{ __('Description') }}</label> <span class="text-primary">*</span>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="attachment">{{ __('Attachment (You can select multiple files)') }}</label>
                                        <div class="custom-file multiple-file @error('attachment.*') is-invalid @enderror">
                                            <input type="file" class="custom-file-input @error('attachment.*') is-invalid @enderror" id="attachment" name="attachment[]" multiple>
                                            <label class="custom-file-label" for="attachment">{{ __('Choose file...') }}</label>
                                        </div>
                                        @error('attachment.*')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8 offset-lg-2 text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-reply"></i> {{ __('Reply Ticket') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@push('header_css')
    <link href="{{ asset('frontend/vendor/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
@endpush

@push('footer_scripts')
    <script src="{{ asset('frontend/vendor/summernote/summernote-bs4.min.js') }}"></script>
@endpush