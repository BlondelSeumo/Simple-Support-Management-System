@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-users"></i> {{ __('user.user') }}</h1>

            <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <a class="text-white"><i class="fas fa-users fa-sm text-white-50"></i> {{ __('user.user') }}</a> /
                <a class="text-white">{{ __('View') }}</a>
            </span>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="profile-widget-header text-center p-2 mb-0">
                        <img alt="image" src="{{ $user->image }}" class="rounded-circle profile-widget-picture" />
                        <h3>{{ $user->name }}</h3>
                        <ul class="list-group text-left profile-list">
                          <li class="list-group-item"><b>{{ __('Designation') }}:</b> {{ $user->designation }}</li>
                          <li class="list-group-item"><b>{{ __('Phone') }}:</b> {{ $user->phone }}</li>
                          <li class="list-group-item"><b>{{ __('Email') }}:</b> {{ $user->email }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __('User Details') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>{{ __('Name') }}</label> <span class="text-danger">*</span>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}"/>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>{{ __('Date of Birth') }}</label> <span class="text-danger">*</span>
                                <input type="text" name="date_of_birth" class="form-control datepicker" value="{{ $user->date_of_birth->format('d-m-Y') }}"/>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>{{ __('Joining Date') }}</label> <span class="text-danger">*</span>
                                <input type="text" name="joining_date" class="form-control datepicker" value="{{ $user->joining_date->format('d-m-Y') }}"/>
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{ __('Username') }}</label> <span class="text-danger">*</span>
                                <input type="text" name="username" class="form-control" value="{{ $user->username }}"/>
                            </div>

                            <div class="form-group col-md-12">
                                <label>{{ __('Address') }}</label> <span class="text-danger">*</span>
                                <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ $user->address }}</textarea>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection