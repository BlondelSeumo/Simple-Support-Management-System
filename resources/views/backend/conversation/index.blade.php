@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-comments"></i> {{ __('conversation.conversation') }}</h1>

			<span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            	<a class="text-white"><i class="fas fa-comments fa-sm text-white-50"></i> {{ __('conversation.conversation') }}</a>
			</span>
        </div>

		<conversation :authuser="{{ auth()->user() }}" :chatuser="{{ $chatuser }}"></conversation>
    </div>
    <!-- /.container-fluid -->
@endsection
