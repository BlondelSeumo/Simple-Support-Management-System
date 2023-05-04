@extends('_frontend_layout')

@section('content')

    <!-- Contact-->
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0">{{ __('frontend.let_touch') }}</h2>
                    <hr class="divider my-4" />
                    <p class="text-muted mb-5">{{ __('frontend.contact_description') }}</p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                    <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                    <a class="d-block text-decoration-none" href="tel:{{ setting('phone') }}">{{ setting('phone') }}</a>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                    <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                    <a class="d-block text-decoration-none" href="mailto:{{ setting('email') }}">{{ setting('email') }}</a>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-8 offset-2">
                    <div class="googleMap text-center" >
                        <h2 class="mt-0">Our Google Map Location</h2>
                        <hr class="divider my-4" />
                        {!! setting('google_map') !!}
                    </div>
                </div>
            </div>
        </div>
    </section

@endsection
