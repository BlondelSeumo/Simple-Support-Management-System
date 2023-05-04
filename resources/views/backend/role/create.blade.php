@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-sliders-h"></i> {{ __('role.role') }}</h1>

            <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <a href="{{ route('admin.role.index') }}" class="text-white"><i class="fas fa-sliders-h fa-sm text-white-50"></i> {{ __('role.role') }}</a> / 
                <a class="text-white">{{ __('role.add') }}</a>
            </span>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <form method="POST" action="<?=route('admin.role.store')?>">
                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('role.name') }}</label> <span class="text-danger">*</span>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"/>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('role.create_role') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection