@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-shield"></i> {{ __('Permission') }}</h1>

            <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <a class="text-white"><i class="fas fa-user-shield fa-sm text-white-50"></i> {{ __('Permission') }}</a>
            </span>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card shadow mb-4">
                    <form action="{{ route('admin.permission.save', $role) }}" method="POST">
                        @csrf
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-4 offset-md-4 text-center">
                                    <select name="roleID" id="permissionrole" class="form-control">
                                        @if(!blank($roles))
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $selectRoleID == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('#') }}</th>
                                            <th>{{ __('Module Name') }}</th>
                                            <th>{{ __('Create') }}</th>
                                            <th>{{ __('Edit') }}</th>
                                            <th>{{ __('Destroy') }}</th>
                                            <th>{{ __('Show') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($permissionList)) { foreach($permissionList as $permission) { ?>
                                            <tr>
                                                <td> 
                                                    <input type="checkbox" id="<?=$permission->name?>" name="<?=$permission->name?>" value="<?=$permission->id?>"  <?=isset($permissions[$permission->id]) ? 'checked' : ''?> onclick="processCheck(this);" class="mainmodule"/> 
                                                </td>
                                                <td>
                                                    <?=ucfirst($permission->name)?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $permissionCreate = $permission->name.'_create';
                                                        if(isset($permissionArray[$permissionCreate])) { ?>
                                                            <input type="checkbox" id="<?=$permissionCreate?>" name="<?=$permissionCreate?>" value="<?=$permissionArray[$permissionCreate]?>" <?=isset($permissions[$permissionArray[$permissionCreate]]) ? 'checked' : ''?> />
                                                    <?php } else {
                                                        echo "&nbsp;";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $permissionEdit = $permission->name.'_edit';
                                                        if(isset($permissionArray[$permissionEdit])) { ?>
                                                            <input type="checkbox" id="<?=$permissionEdit?>" name="<?=$permissionEdit?>" value="<?=$permissionArray[$permissionEdit]?>" <?=isset($permissions[$permissionArray[$permissionEdit]]) ? 'checked' : ''?> />
                                                    <?php } else {
                                                        echo "&nbsp;";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $permissionDestroy = $permission->name.'_destroy';
                                                        if(isset($permissionArray[$permissionDestroy])) { ?>
                                                            <input type="checkbox" id="<?=$permissionDestroy?>" name="<?=$permissionDestroy?>" value="<?=$permissionArray[$permissionDestroy]?>" <?=isset($permissions[$permissionArray[$permissionDestroy]]) ? 'checked' : ''?> />
                                                    <?php } else {
                                                        echo "&nbsp;";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $permissionShow = $permission->name.'_show';
                                                        if(isset($permissionArray[$permissionShow])) { ?>
                                                            <input type="checkbox" id="<?=$permissionShow?>" name="<?=$permissionShow?>" value="<?=$permissionArray[$permissionShow]?>" <?=isset($permissions[$permissionArray[$permissionShow]]) ? 'checked' : ''?> />
                                                    <?php } else {
                                                        echo "&nbsp;";
                                                    } ?>
                                                </td>
                                            </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary mr-1" type="submit">{{ __('Save Permission') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@push('footer_scripts')
    <script src="{{ asset('backend/js/permission.js') }}"></script>
@endpush