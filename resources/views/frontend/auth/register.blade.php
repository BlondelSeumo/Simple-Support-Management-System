@extends('_frontend_layout')

@section('content')        

    <!-- Services-->
    <section class="page-section">
        <div class="container">
            <h2 class="text-center mt-0">{{ __('frontend.welcome_back') }}</h2>
            <hr class="divider my-4"/>
            <div class="row mt-5">
                <div class="col-sm-8 offset-sm-2">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>{{ __('frontend.name') }}</label> <span class="text-danger">*</span>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"/>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>{{ __('frontend.email') }}</label> <span class="text-danger">*</span>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"/>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>{{ __('frontend.phone') }}</label> <span class="text-danger">*</span>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"/>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>{{ __('frontend.address') }}</label> <span class="text-danger">*</span>
                                <textarea name="address" id="address" cols="30" rows="1" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            
                            <hr class="w-100">
                            <div class="form-group col-md-6">
                                <label>{{ __('frontend.username') }}</label> <span class="text-danger">*</span>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"/>
                                @error('username')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>{{ __('frontend.password') }}</label> <span class="text-danger">*</span>
                                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"/>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('frontend.register_or_sign_up') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
        