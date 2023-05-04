@extends('_main_layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-cog"></i> {{ __('setting.setting') }}</h1>

			<span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            	<a class="text-white"><i class="fas fa-cog fa-sm text-white-50"></i> {{ __('setting.setting') }}</a>
			</span>
        </div>

        <!-- Content Row -->
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="row">
    				<div class="col-xl-12 col-md-12">
  						<ul class="nav nav-pills" id="setting" role="tablist">
						    <li class="nav-item">
						        <a class="nav-link {{ activesetting('generalsetting') ? 'active' : '' }}" data-toggle="pill" href="#generalsetting" role="tab" aria-controls="generalsetting" aria-selected="true">{{ __('setting.general_setting') }}</a>
						    </li>
						    <li class="nav-item">
						        <a class="nav-link {{ activesetting('emailsettting') ? 'active' : '' }}" data-toggle="pill" href="#emailsettting" role="tab" aria-controls="emailsettting" aria-selected="false">{{ __('setting.email_setting') }}</a>
						    </li>
						    <li class="nav-item">
						        <a class="nav-link {{ activesetting('pagesettting') ? 'active' : '' }}" data-toggle="pill" href="#pagesettting" role="tab" aria-controls="pagesettting" aria-selected="false">{{ __('setting.page_setting') }}</a>
						    </li>
						</ul>
                	</div>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <div class="row">
    				<div class="col-xl-12 col-md-12">
						<div class="tab-content" id="settingContent">
						    <div class="tab-pane fade {{ activesetting('generalsetting') ? 'show active' : '' }}" id="generalsetting" role="tabpanel" aria-labelledby="generalsetting">
						        <form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
						        	@csrf
						        	<input type="hidden" name="settingtype" value="generalsetting">
									<fieldset class="setting-fieldset">
										<legend class="setting-legend">{{ __('General Setting') }}</legend>
						                <div class="row">
						                	<div class="col-sm-6">
						                		<div class="form-group">
													<label for="site_name">{{ __('Site Name') }}</label> <span class="text-danger">*</span>
													<input name="site_name" id="site_name" type="text" class="form-control @error('site_name') is-invalid @enderror" value="{{ old('site_name', setting('site_name')) }}">
													@error('site_name')
														<div class="invalid-feedback">
															<strong>{{ $message }}</strong>
														</div>
													@enderror
												</div>

												<div class="form-group">
													<label for="phone">{{ __('Phone') }}</label> <span class="text-danger">*</span>
													<input name="phone" id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', setting('phone')) }}">
													@error('phone')
														<div class="invalid-feedback">
															<strong>{{ $message }}</strong>
														</div>
													@enderror
												</div>

											  	<div class="form-group">
											    	<label for="site_logo">{{ __('Logo') }} <span class="text-danger">*</span></label>
											  		<div class="custom-file">
													    <input type="file" name="site_logo" class="custom-file-input upload-file-input @error('site_logo') is-invalid @enderror" id="site_logo">
													    <label class="custom-file-label" for="site_logo">{{ __('Choose file') }}</label>
													</div>
													@error('site_logo')
														<div class="invalid-feedback">
															<strong>{{ $message }}</strong>
														</div>
													@enderror
													<img class="img-thumbnail image-width mt-2 mb-2 setting-logo" src="{{ asset('image/'.setting('site_logo')) }}" alt="{{ setting('site_name') }} Logo">
											  	</div>

											  	<div class="form-group">
												    <label for="timezone">{{ __('Timezone') }} <span class="text-danger">*</span></label>
												    <select class="form-control @error('timezone') is-invalid @enderror" id="timezone" name="timezone">
														<?php if(!blank($timezones)) { foreach($timezones as $timezoneKey => $timezone) { ?>
															<option value="{{ $timezoneKey }}" {{ $timezoneKey == setting('timezone') ? 'selected' : ''}}>{{ $timezone }}</option>
														<?php } } ?>
												    </select>
												    @error('timezone')
														<div class="invalid-feedback">
															<strong>{{ $message }}</strong>
														</div>
													@enderror
												</div>

						                	</div>
						                	<div class="col-sm-6">
						                		<div class="form-group">
													<label for="email">{{ __('Email') }}</label> <span class="text-danger">*</span>
													<input name="email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', setting('email')) }}">
													@error('email')
														<div class="invalid-feedback">
															<strong>{{ $message }}</strong>
														</div>
													@enderror
												</div>
												<div class="form-group">
													<label for="copyright_by">{{ __('Copyright By') }}</label> <span class="text-danger">*</span>
													<input name="copyright_by" id="copyright_by" type="text" class="form-control @error('copyright_by') is-invalid @enderror" value="{{ old('copyright_by', setting('copyright_by')) }}">
													@error('copyright_by')
														<div class="invalid-feedback">
															<strong>{{ $message }}</strong>
														</div>
													@enderror
												</div>
											  	<div class="form-group">
											    	<label for="address">{{ __('Address') }} <span class="text-danger">*</span></label>
											    	<textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="4" placeholder="Enter Your Address">{{ old('address', setting('address')) }}</textarea>
											    	@error('address')
														<div class="invalid-feedback">
															<strong>{{ $message }}</strong>
														</div>
													@enderror
											  	</div>
						                	</div>
						                </div>
						            </fieldset>

						            <fieldset class="setting-fieldset">
										<legend class="setting-legend">{{ __('setting.onesignal_setting') }}</legend>
						                <div class="row">
						                	<div class="col-sm-6">
						                		<div class="form-group">
													<label for="onesignal_app_id">{{ __('App ID') }}</label> <span class="text-danger">*</span>
													<input name="onesignal_app_id" id="onesignal_app_id" type="text" class="form-control @error('onesignal_app_id') is-invalid @enderror" value="{{ old('onesignal_app_id', setting('onesignal_app_id')) }}">
													@error('onesignal_app_id')
														<div class="invalid-feedback">
															<strong>{{ $message }}</strong>
														</div>
													@enderror
												</div>

						                	</div>
						                	<div class="col-sm-6">
						                		<div class="form-group">
													<label for="onesignal_subdomain_name">{{ __('Subdomain Name') }}</label> <span class="text-danger">*</span>
													<input name="onesignal_subdomain_name" id="onesignal_subdomain_name" type="text" class="form-control @error('onesignal_subdomain_name') is-invalid @enderror" value="{{ old('onesignal_subdomain_name', setting('onesignal_subdomain_name')) }}">
													@error('onesignal_subdomain_name')
														<div class="invalid-feedback">
															<strong>{{ $message }}</strong>
														</div>
													@enderror
												</div>
						                	</div>
						                </div>
						            </fieldset>

                                    <fieldset class="setting-fieldset">
                                        <legend class="setting-legend">{{ __('setting.google_map_setting') }}</legend>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="google_map">{{ __('Google Map') }} <span class="text-danger">*</span></label>
                                                    <textarea name="google_map" class="form-control @error('google_map') is-invalid @enderror" cols="30" rows="4" placeholder="Enter Your Google Map">{{ old('google_map', setting('google_map')) }}</textarea>
                                                    @error('google_map')
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

									<button type="submit" class="btn btn-primary">{{ __('setting.save_changes') }}</button>
					        	</form>
						    </div>

						    <div class="tab-pane fade {{ activesetting('emailsettting') ? 'show active' : '' }}" id="emailsettting" role="tabpanel" aria-labelledby="emailsettting">
						        <form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
						        	@csrf
						        	<input type="hidden" name="settingtype" value="emailsettting">
									<fieldset class="setting-fieldset">
										<legend class="setting-legend">{{ __('SMTP Setting') }}</legend>
						                <div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="mail_host">{{ __('Mail Host') }}</label> <span class="text-danger">*</span>
													<input name="mail_host" id="mail_host" type="text" class="form-control @error('mail_host') is-invalid @enderror" value="{{ old('mail_host', setting('mail_host')) }}">
													@error('mail_host')
														<div class="invalid-feedback">
															<strong>{{ $message }}</strong>
														</div>
													@enderror
												</div>

												<div class="form-group">
													<label for="mail_username">{{ __('Mail Username') }}</label> <span class="text-danger">*</span>
													<input name="mail_username" id="mail_username" type="text" class="form-control @error('mail_username') is-invalid @enderror" value="{{ old('mail_username', setting('mail_username')) }}">
													@error('mail_username')
													<div class="invalid-feedback">
														<strong>{{ $message }}</strong>
													</div>
													@enderror
												</div>

												<div class="form-group">
													<label for="mail_encryption">{{ __('Mail Encryption') }}</label> <span class="text-danger">*</span>
													<input name="mail_encryption" id="mail_encryption" type="text" class="form-control @error('mail_encryption') is-invalid @enderror" value="{{ old('mail_encryption', setting('mail_encryption')) }}">
													@error('mail_encryption')
													<div class="invalid-feedback">
														<strong>{{ $message }}</strong>
													</div>
													@enderror
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label for="mail_port">{{ __('Mail Port') }}</label> <span class="text-danger">*</span>
													<input name="mail_port" id="mail_port" class="form-control @error('mail_port') is-invalid @enderror" value="{{ old('mail_port', setting('mail_port')) }}">
													@error('mail_port')
													<div class="invalid-feedback">
														<strong>{{ $message }}</strong>
													</div>
													@enderror
												</div>

												<div class="form-group">
													<label for="mail_password">{{ __('Mail Password') }}</label> <span class="text-danger">*</span>
													<input name="mail_password" id="mail_password" type="text" class="form-control @error('mail_password') is-invalid @enderror" value="{{ old('mail_password', setting('mail_password')) }}">
													@error('mail_password')
													<div class="invalid-feedback">
														<strong>{{ $message }}</strong>
													</div>
													@enderror
												</div>
                                                <div class="form-group">
                                                    <label for="mail_from_address">{{ __('Mail From Address') }}</label> <span class="text-danger">*</span>
                                                    <input name="mail_from_address" id="mail_from_address" type="text" class="form-control @error('mail_from_address') is-invalid @enderror" value="{{ old('mail_from_address', setting('mail_from_address')) }}">
                                                    @error('mail_from_address')
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                </div>

											</div>
										</div>
						            </fieldset>
									<button type="submit" class="btn btn-primary">{{ __('setting.save_changes') }}</button>
					        	</form>
						    </div>

							<div class="tab-pane fade {{ activesetting('pagesettting') ? 'show active' : '' }}" id="pagesettting" role="tabpanel" aria-labelledby="pagesettting">
						        <form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
						        	@csrf
						        	<input type="hidden" name="settingtype" value="pagesettting">
									<fieldset class="setting-fieldset">
										<legend class="setting-legend">{{ __('Facebook Page ID') }}</legend>
						                <div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label for="page_id">{{ __('Page ID') }}</label> <span class="text-danger">*</span>
													<input name="page_id" id="page_id" type="text" class="form-control @error('page_id') is-invalid @enderror" value="{{ old('page_id', setting('page_id')) }}">
													@error('page_id')
														<div class="invalid-feedback">
															<strong>{{ $message }}</strong>
														</div>
													@enderror
												</div>
											</div>
										</div>
						            </fieldset>
									<button type="submit" class="btn btn-primary">{{ __('setting.save_changes') }}</button>
					        	</form>
						    </div>
						</div>
					</div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
