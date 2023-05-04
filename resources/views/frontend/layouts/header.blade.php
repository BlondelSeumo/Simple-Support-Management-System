<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="{{ setting('site_name') }}" />
        <meta name="author" content="{{ setting('site_name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ setting('site_name') }}</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ site_logo() }}" />

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend/vendor/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('backend/vendor/izitoast/dist/css/iziToast.min.css') }}" />

        <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet" />

        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="app">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 navbar-scrolled" id="mainNav">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('frontend.index') }}">{{ setting('site_name', 'Green Support') }}</a>

                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto my-2 my-lg-0">
                            <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('frontend.index') }}">{{ __('global.home') }}</a></li>

                            <li class="nav-item"><a class="nav-link {{ request()->is('ticket') ? 'active' : '' }}" href="{{ route('frontend.ticket') }}">{{ __('global.ticket') }}</a></li>

                            @if (Auth::check())
                                <li class="nav-item"><a class="nav-link {{ request()->is('myticket') ? 'active' : '' }}" href="{{ route('frontend.myticket.index') }}">{{ __('global.my_ticket') }}</a></li>

                                <li class="nav-item"><a class="nav-link {{ request()->is('livechat') ? 'active' : '' }}" href="{{ route('frontend.livechat.index') }}">{{ __('global.live_chat') }}</a></li>
                            @endif

                            <li class="nav-item"><a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="{{ route('frontend.faq') }}">{{ __('global.faq') }}</a></li>

                            <li class="nav-item"><a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('frontend.contact') }}">{{ __('global.contact') }}</a></li>

                            @if (Auth::check())
                                <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('global.logout') }}</a></li>

                                @if(!auth()->user()->hasRole($clientRole->name))
                                    <li class="nav-item"><a target="_blank" class="nav-link" href="{{ route('admin.dashboard.index') }}">{{ __('global.admin_panel')}}</a></li>
                                @endif
                            @else
                                <li class="nav-item"><a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">{{ __('global.login') }}</a></li>

                                <li class="nav-item"><a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{ route('register') }}">{{ __('global.register') }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
