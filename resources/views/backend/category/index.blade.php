@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-tag"></i> {{ __('category.category') }}</h1>

            <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <a class="text-white"><i class="fas fa-tag fa-sm text-white-50"></i> {{ __('category.category') }}</a>
            </span>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card shadow mb-4">
                    @can('category_create')
                        <div class="card-header py-3">
                            <div class="row">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <a href="{{ route('admin.category.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('category.add_category') }}</a>
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
                                        <th>{{ __('category.name') }}</th>
                                        @if(auth()->user()->can('category_edit') || auth()->user()->can('category_destroy'))
                                            <th>{{ __('category.action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!blank($categories))
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $category->name }}</td>
                                                @if(auth()->user()->can('category_edit') || auth()->user()->can('category_destroy'))
                                                    <td>
                                                        @can('category_edit')
                                                            <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View"><i class="fas fa-edit"></i></a>
                                                        @endcan

                                                        @can('category_destroy')
                                                            <form class="d-inline-block" action="{{ route('admin.category.destroy', $category) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                            </form>
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
                                        <th>{{ __('category.name') }}</th>
                                        @if(auth()->user()->can('category_edit') || auth()->user()->can('category_destroy'))
                                            <th>{{ __('category.action') }}</th>
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