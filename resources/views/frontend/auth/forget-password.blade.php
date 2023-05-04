@extends('_frontend_layout')

@section('content')        

    <!-- Services-->
    <section class="page-section">
        <div class="container">
            <h2 class="text-center mt-0">{{ __('frontend.welcome_back') }}</h2>
            <hr class="divider my-4"/>
            <div class="row mt-5">
                <div class="col-lg-6 offset-lg-3">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __('frontend.email') }}</label> <span class="text-danger">*</span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" name="email" value="{{ old('email') }}"/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('frontend.send_reset_link') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
        