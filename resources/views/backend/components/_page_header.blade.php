<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>@yield('title',  'Green Support')</title>
        <link rel="icon" type="image/x-icon" href="{{ site_logo() }}" />

        <!-- Custom fonts for this template-->
        <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

        <!-- Custom styles for this template-->
        <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('backend/vendor/izitoast/dist/css/iziToast.min.css') }}" />

        @stack('header_css')
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" />

        @stack('header_scripts')

    </head>

    <body class="sidebar-toggled">
        <div id="app">
            <!-- Page Wrapper -->
            <div id="wrapper">
                
                @include('backend.components._page_sidebar')

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">
                    
                    <!-- Main Content -->
                    <div id="content">
                        <!-- Topbar -->
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                            <!-- Sidebar Toggle (Topbar) -->
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>

                            <!-- Topbar Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link" target="_blank" href="{{ route('frontend.index') }}"><i class="fas fa-globe fa-fw"></i>
                                  </a>
                                </li>

                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="{{ route('admin.profile.index') }}" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                        <img class="img-profile rounded-circle" src="{{ auth()->user()->image }}" />
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('global.profile') }}
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('global.logout') }}
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <!-- End of Topbar -->