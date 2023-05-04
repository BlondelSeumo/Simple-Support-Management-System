@extends('_frontend_layout')

@section('content')        

    <!-- Services-->
    <section class="page-section">
        <div class="container">
            <h2 class="text-center mt-0">{{ __('frontend.welcome_back') }}</h2>
            <hr class="divider my-4"/>
            <div class="row mt-5">
                <div class="col-lg-6 offset-lg-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __('frontend.email') }}</label> <span class="text-danger">*</span>
                            <input type="email" id="demoemail" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" name="email" value="{{ old('email') }}"/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('frontend.password') }}</label> <span class="text-danger">*</span>
                            <input type="password" id="demopassword" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" name="password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('frontend.remember_me') }}
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('frontend.login') }}
                        </button>
                    </form>
                    <hr />
                    <div class="text-center">
                        @if (Route::has('password.request'))
                            <a class="small" href="{{ route('password.request') }}">
                                {{ __('frontend.forget_your_password') }}
                            </a>
                        @endif
                    </div>
                    <div class="text-center">
                        <a class="small" href="{{ route('register') }}">{{ __('frontend.create_an_account') }}</a>
                    </div>
                </div>
            </div>
            @if(env('DEMO'))
                <div class="row">
                    <div class="col-sm-6 offset-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <strong>Login Panel</strong><br/>
                                <button class="btn btn-primary" id="demoadmin">Admin</button>
                                <button class="btn btn-warning" id="demosupport">Support Engineer</button>
                                <button class="btn btn-success" id="democlient">Client</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection