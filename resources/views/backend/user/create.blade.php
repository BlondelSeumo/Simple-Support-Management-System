@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-users"></i> {{ __('user.user') }}</h1>

            <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <a href="{{ route('admin.user.index') }}" class="text-white"><i class="fas fa-users fa-sm text-white-50"></i> {{ __('user.user') }}</a> / 
                <a class="text-white">{{ __('Add') }}</a>
            </span>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <form method="POST" action="<?=route('admin.user.store')?>" enctype="multipart/form-data">
                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>{{ __('Name') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"/>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label>{{ __('Desingation') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation') }}"/>
                                    @error('designation')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label>{{ __('Email') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"/>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label>{{ __('Phone') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"/>
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label>{{ __('Date of Birth') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="date_of_birth" class="form-control datepicker @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}"/>
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label>{{ __('Joining Date') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="joining_date" class="form-control datepicker @error('joining_date') is-invalid @enderror" value="{{ old('joining_date') }}"/>
                                    @error('joining_date')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{ __('Photo') }}</label> <span class="text-danger">*</span>
                                    <div class="custom-file">
                                        <input name="image" type="file" class="custom-file-input upload-file-input @error('image') is-invalid @enderror" id="userphoto">
                                        <label class="custom-file-label" for="userphoto">{{ __('Choose file') }}</label>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    <img class="img-thumbnail image-width mt-2 mb-2 setting-logo" src="{{ asset('image/avatar-1.png') }}" alt="">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>{{ __('Address') }}</label> <span class="text-danger">*</span>
                                    <textarea name="address" id="address" cols="30" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <hr class="w-100">
                                
                                <div class="form-group col-md-4">
                                    <label>{{ __('user.role') }}</label> <span class="text-danger">*</span>
                                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value="0">{{ __('Please Select') }}</option>
                                        @if(!blank($roles))
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ (old('role') == $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{ __('Username') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"/>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label>{{ __('Password') }}</label>
                                    <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"/>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Create User') }}</button>
                        </div>
                    </div>
                </form>
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