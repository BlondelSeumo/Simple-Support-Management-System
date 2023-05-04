@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-sliders-h"></i> {{ __('role.role') }}</h1>

            <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <a class="text-white"><i class="fas fa-sliders-h fa-sm text-white-50"></i> {{ __('role.role') }}</a>
            </span>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card shadow mb-4">
                    @can('role_create')
                        <div class="card-header py-3">
                            <div class="row">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <a href="{{ route('admin.role.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('role.add_role') }}</a>
                                </h6>
                            </div>
                        </div>
                    @endcan
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('role.name') }}</th>
                                        @if(auth()->user('role_edit') || auth()->user('role_destroy'))
                                            <th>{{ __('role.action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!blank($roles))
                                        @foreach($roles as $role)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $role->name }}</td>
                                                @if(auth()->user('role_edit') || auth()->user('role_destroy'))
                                                    <td>
                                                        @can('role_edit')
                                                            <a href="{{ route('admin.role.edit', $role) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View"><i class="fas fa-edit"></i></a>
                                                        @endcan
                                                        @can('role_destroy')
                                                            @if(!in_array($role->id, $notDeleteArray))
                                                                <form class="d-inline-block" action="{{ route('admin.role.destroy', $role) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                                </form>
                                                            @endif
                                                        @endcan
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('role.name') }}</th>
                                        @if(auth()->user('role_edit') || auth()->user('role_destroy'))
                                            <th>{{ __('role.action') }}</th>
                                        @endif
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@push('header_css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('footer_scripts')
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush