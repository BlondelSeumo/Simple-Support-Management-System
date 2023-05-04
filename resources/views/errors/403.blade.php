@extends('_frontend_layout')

@section('content')        

    <!-- Services-->
    <section class="page-section">
        <div class="container">
            <h2 class="text-center mt-0 text-primary">{{ __('frontend.error_403') }}</h2>
            <hr class="divider my-4" />
            <div class="text-center">
                <h1>{{ __('frontend.oops') }}</h1>
                <div class="text-black">
                    {{ __('frontend.your_does_not_have_permission') }}
                </div>
                <div class="mt-3">
                    <a href="{{ route('frontend.contact') }}" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-envelope"></span> 
                        {{ __('frontend.contact_us') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
