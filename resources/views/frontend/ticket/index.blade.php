@extends('_frontend_layout')

@section('content')        

    <!-- Services-->
    <section class="page-section">
        <div class="container">
            <h2 class="text-center mt-0">{{ __('frontend.create_your_ticket') }}</h2>
            <hr class="divider my-4" />
            <form method="POST" action="{{ route('frontend.ticket.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">{{ __('frontend.name') }}</label> <span class="text-primary">*</span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value="{{ old('name', auth()->user()->name ?? '') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email">{{ __('frontend.email') }}</label> <span class="text-primary">*</span>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="category_id">{{ __('frontend.category') }}</label> <span class="text-primary">*</span>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="0">{{ __('frontend.select_category') }}</option>
                                @if(!blank($categories))
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ (old('category_id') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="subject">{{ __('frontend.subject') }}</label> <span class="text-primary">*</span>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" placeholder="Subject" name="subject" value="{{ old('subject') }}">
                            @error('subject')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group @error('description') ticket-error @enderror">
                            <label for="description">{{ __('frontend.description') }}</label> <span class="text-primary">*</span>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
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
                    <div class="col text-center mt-3">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> {{ __('frontend.create_ticket') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
        