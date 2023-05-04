@extends('_frontend_layout')

@section('content')        

    <!-- Services-->
    <section class="page-section">
        <div class="container">
            <h2 class="text-center mt-0">
                {{ __('Reset Password') }}
            </h2>
            <hr class="divider my-4"/>
            <div class="row mt-5">
                <div class="col-sm-8 offset-sm-2">
                    <form method="POST" action="{{ route('password.update') }}" class="user">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Enter Email Address" name="email" value="{{ old('email', request('email')) }}"/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password') }}"/>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation" value="{{ old('password_confirmation') }}"/>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('Reset Password') }}
                        </button>
                    </form>
                    <hr />
                    <div class="text-center">
                        <a class="small" href="{{ route('register') }}">
                            {{ __('Create an Account!') }}
                        </a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="{{ route('login') }}">{{ __('Already have an account? Login!') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
        