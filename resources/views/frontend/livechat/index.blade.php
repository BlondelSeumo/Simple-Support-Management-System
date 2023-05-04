@extends('_frontend_layout')

@section('content')        

    <!-- Services-->
    <section class="page-section">
        <div class="container">
            <h2 class="text-center mt-0">{{ __('frontend.live_chat_with_support_team') }}</h2>
            <hr class="divider my-4" />

            <livechat :user="{{ auth()->user() }}" :chatuser="{{ $chatuser }}"></livechat>
            
        </div>
    </section>

@endsection
        