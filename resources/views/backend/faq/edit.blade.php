@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-question-circle"></i> {{ __('faq.faq') }}</h1>

            <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <a href="{{ route('admin.faq.index') }}" class="text-white"><i class="fas fa-question-circle fa-sm text-white-50"></i> {{ __('faq.faq') }}</a> /
                <a class="text-white">{{ __('faq.update') }}</a>
            </span>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <form method="POST" action="<?=route('admin.faq.update', $faq)?>">
                    @csrf
                    @method('PUT')
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('faq.title') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $faq->title) }}"/>
                                    @error('title')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">{{ __('frontend.status') }}</label> <span class="text-danger">*</span>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="0">Select Status</option>
                                        @foreach(trans('faq_status') as $statusKey=> $status)
                                            <option value="{{ $statusKey }}" {{ (old('status', $faq->status) == $statusKey) ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group @error('description') ticket-error @enderror">
                                        <label for="description">{{ __('frontend.description') }}</label> <span class="text-danger">*</span>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $faq->description) }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('faq.update_faq') }}</button>
                        </div>
                    </div>
                </form>
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
    <script>
        $('#description').summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            height: 250
        });
    </script>
@endpush
