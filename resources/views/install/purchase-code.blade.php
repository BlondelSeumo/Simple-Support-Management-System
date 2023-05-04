@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.menu.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-unlock" aria-hidden="true"></i>
    {{ trans('installer_messages.purchase_code') }}
@endsection

@section('container')

    <form method="post" action="{{ route('install.set-purchase-code') }}" class="tabs-wrap">

        @csrf

        <div class="form-group {{ $errors->has('purchase_code') ? ' has-error ' : '' }}">
            <label for="purchase_code">
                {{ __('Purchase Code') }} <span class="text-danger">*</span>
            </label>
            <input type="text" name="purchase_code" value="{{ old('purchase_code') }}" id="purchase_code" placeholder="{{ __('Enter Purchase Code') }}" required/>
            @if ($errors->has('purchase_code'))
                <span class="error-block">
                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('purchase_code') }}
                </span>
            @endif
        </div>

        <div class="buttons">
            <button class="button" type="submit">
                {{ __('Verify Purchase Code') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </form>

@endsection
