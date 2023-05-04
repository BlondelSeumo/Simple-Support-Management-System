@extends('_frontend_layout')

@section('content')        

    <!-- Masthead-->
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-uppercase text-white font-weight-bold">
                        {{ __('frontend.welcome_to_you') }} <span class="text-primary">{{ setting('site_name') }}</span>
                    </h1>
                    <hr class="divider my-4" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 font-weight-light mb-5">
                        <span class="text-primary">{{ setting('site_name') }}</span> {{ __('frontend.welcome_message') }}
                    </p>
                    <a class="btn btn-primary btn-xl" href="{{ route('frontend.ticket') }}">
                        {{ __('frontend.create_your_ticket') }}
                    </a>
                </div>
            </div>
        </div>
    </header>
    
    <!-- About-->
    <section class="page-section bg-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">{{ __('frontend.custom_query') }}</h2>
                    <hr class="divider light my-4" />
                    <p class="text-white mb-4">
                        {{ __('frontend.custom_query_message') }}
                    </p>
                    <a class="btn btn-light btn-xl" href="{{ route('frontend.contact') }}">{{ __('frontend.get_started') }}</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Services-->
    <section class="page-section">
        <div class="container">
            <h2 class="text-center mt-0">{{ __('frontend.service_any_time') }}</h2>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-ticket-alt text-primary mb-4"></i>
                        <h3 class="h4 mb-2">{{ __('frontend.create_ticket') }}</h3>
                        <p class="text-muted mb-0">{{ __('frontend.create_ticket_message') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fab fa-4x fa-rocketchat text-primary mb-4"></i>
                        <h3 class="h4 mb-2">{{ __('frontend.chat') }}</h3>
                        <p class="text-muted mb-0">{{ __('frontend.chat_message') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-globe text-primary mb-4"></i>
                        <h3 class="h4 mb-2">{{ __('frontend.review') }}</h3>
                        <p class="text-muted mb-0">{{ __('frontend.review_message') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-heart text-primary mb-4"></i>
                        <h3 class="h4 mb-2">{{ __('frontend.complete') }}</h3>
                        <p class="text-muted mb-0">{{ __('frontend.complete_message') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
        