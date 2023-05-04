@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fa fa-user"></i> {{ __('profile.profile') }}</h1>
        </div>

        <!-- Content Row -->
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="card">
                    <div class="profile-widget-header text-center p-2 mb-0">
                        <img alt="image" src="{{ $user->image }}" class="rounded-circle profile-widget-picture" />
                        <h3>{{ $user->name }}</h3>
                        <ul class="list-group text-left profile-list">
                          <li class="list-group-item"><b>{{ __('profile.designation') }}:</b> {{ $user->designation }}</li>
                          <li class="list-group-item"><b>{{ __('profile.phone') }}:</b> {{ $user->phone }}</li>
                          <li class="list-group-item"><b>{{ __('profile.email') }}:</b> {{ $user->email }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <form method="POST" action="<?=route('admin.profile.update')?>" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4 class="mb-0">{{ __('profile.edit_profile') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('profile.name') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}"/>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>{{ __('profile.desingation') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation', $user->designation) }}"/>
                                    @error('designation')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>{{ __('profile.email') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}"/>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>{{ __('profile.phone') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}"/>
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>{{ __('profile.date_of_birth') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="date_of_birth" class="form-control datepicker @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $user->date_of_birth->format('d-m-Y')) }}"/>
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>{{ __('profile.joining_date') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="joining_date" class="form-control datepicker @error('joining_date') is-invalid @enderror" value="{{ old('joining_date', $user->joining_date->format('d-m-Y')) }}"/>
                                    @error('joining_date')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{ __('profile.photo') }}</label> <span class="text-danger">*</span>
                                    <div class="custom-file">
                                        <input name="image" type="file" class="custom-file-input upload-file-input @error('image') is-invalid @enderror" id="userphoto">
                                        <label class="custom-file-label" for="userphoto">{{ __('profile.choose_file') }}</label>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <img class="img-thumbnail image-width mt-2 mb-2 setting-logo" src="{{ $user->image }}" alt="{{ setting('image') }} Logo">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>{{ __('profile.address') }}</label> <span class="text-danger">*</span>
                                    <textarea name="address" id="address" cols="30" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <hr class="w-100">
                                <div class="form-group col-md-6">
                                    <label>{{ __('profile.username') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}"/>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>{{ __('profile.password') }}</label>
                                    <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"/>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">{{ __('profile.save_changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@push('header_css')
    <link href="{{ asset('backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endpush

@push('footer_scripts')
<script src="{{ asset('backend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endpush