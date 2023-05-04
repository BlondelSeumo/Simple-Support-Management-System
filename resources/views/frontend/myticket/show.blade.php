@extends('_frontend_layout')

@section('content')        

    <!-- Services-->
    <section class="page-section">
        <div class="container">
            <h2 class="text-center mt-0">{{ __('frontend.my_tickets') }}</h2>
            <span class="text-center mt-0 d-block">{{ $parentTicket->created_at->format('d F Y, h:i A') }}</span>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-sm-12">
                    <ul class="timeline">
                        <li>
                            <fieldset class="timeline-fieldset myticket">
                                <legend class="timeline-legend">{{ __('frontend.you') }}</legend>
                                <a class="text-primary">{{ $parentTicket->subject }}</a>
                                <a class="float-right text-primary">{{ $parentTicket->created_at->format('d F Y, h:i A') }}</a>
                                <?=clean($parentTicket->description, 'default')?>
                                @if(!blank($parentTicket->getMedia('ticket')))
                                    @foreach($parentTicket->getMedia('ticket') as $mediaticket)
                                        <a href="{{ route('frontend.myticket.download', $mediaticket) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ $mediaticket->file_name }}">{{ __('frontend.download') }}</a>
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
                                                {{ __('frontend.you') }}
                                            @else
                                                {{ optional($ticket->user)->name }}
                                            @endif
                                        </legend>
                                        <a class="text-primary">{{ $ticket->subject }}</a>
                                        <a class="float-right text-primary">{{ $ticket->created_at->format('d F Y, h:i A') }}</a>
                                        <?=clean($ticket->description, 'default')?>

                                        @if(!blank($ticket->getMedia('ticket')))
                                            @foreach($ticket->getMedia('ticket') as $mediaticket)
                                                <a href="{{ route('frontend.myticket.download', $mediaticket) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ $mediaticket->file_name }}">{{ __('frontend.download') }}</a>
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
            <form method="POST" action="{{ route('frontend.myticket.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $parentTicket->id}}" name="parent_id">
                <div class="row">
                    <div class="col-sm-8 offset-lg-2">
                        <div class="form-group @error('description') ticket-error @enderror">
                            <label for="description">{{ __('frontend.description') }}</label> <span class="text-primary">*</span>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="attachment">{{ __('frontend.attachment_multiple') }}</label>
                            <div class="custom-file multiple-file @error('attachment.*') is-invalid @enderror">
                                <input type="file" class="custom-file-input @error('attachment.*') is-invalid @enderror" id="attachment" name="attachment[]" multiple>
                                <label class="custom-file-label" for="attachment">{{ __('frontend.choose_file') }}</label>
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
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-reply"></i> {{ __('frontend.reply_ticket') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
        