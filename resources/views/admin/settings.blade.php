@extends('_layouts.admin')
@section('title','Settings')
@section('content')

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title">
					Settings
				</h2>
				<div class="text-muted mt-1">{{ Auth::user()->levelInfo() != null ? Auth::user()->levelInfo()->name : "Admin"  }} Settings</div>
			</div>
		</div>
	</div>
</div>

<div class="page-body">
	<div class="container-xl">
		<div class="row">
			<div class="d-none d-lg-block col-lg-3">
				<div class="list-group bg-white" id="settings-list">
					@if(Auth::user()->isAdmin())
					<a href="#general" class="list-group-item list-group-item-action active" aria-current="true">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle"
							width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
							fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<circle cx="12" cy="12" r="9"></circle>
							<line x1="12" y1="8" x2="12.01" y2="8"></line>
							<polyline points="11 12 12 12 12 16 13 16"></polyline>
						</svg>
						General
					</a>
					<a href="#email" class="list-group-item list-group-item-action">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24"
							height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
							stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<rect x="3" y="5" width="18" height="14" rx="2"></rect>
							<polyline points="3 7 12 13 21 7"></polyline>
						</svg>
						Email Setup
					</a>
					@endif
					<a href="#security" class="list-group-item list-group-item-action">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24"
							height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
							stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<rect x="5" y="11" width="14" height="10" rx="2"></rect>
							<circle cx="12" cy="16" r="1"></circle>
							<path d="M8 11v-4a4 4 0 0 1 8 0v4"></path>
						</svg>
						Security
					</a>
				</div>
			</div>
			<div class="col-lg-9 overflow-auto" style="max-height: 70vh;" data-bs-spy="scroll" data-bs-target="#settings-list">

				@component('_layouts.components.alert')
        		@endcomponent

				@if(Auth::user()->isAdmin())
				<div class="card mb-4" id="general">
					<div class="card-header">
						<h3 class="card-title">General</h3>
					</div>
					<form action="{{ route('post_admin_settings_general') }}" method="post">
						{{ csrf_field() }}
						<div class="card-body">
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">Name</label>
								<div class="col">
									<input
										type="text" required name="name"
										@if($errors->has('name'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('name', $settings->name) }}"
									/>
									@if($errors->has('name'))
										<div class="invalid-feedback">{{ $errors->first('name') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">About</label>
								<div class="col">
									<textarea
										name="page_description" rows="4"
										@if($errors->has('page_description'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
									>{{ $settings->page_description }}</textarea>
									@if($errors->has('page_description'))
										<div class="invalid-feedback">{{ $errors->first('page_description') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Logo</label>
								<div class="col">
									<input type="file" class="form-control" placeholder="" />
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Favicon</label>
								<div class="col">
									<input type="file" class="form-control" placeholder="" />
								</div>
							</div>

							<div class="form-group mb-3 row" style="display: none;">
								<label class="form-label col-12 col-sm-3 col-form-label">Theme</label>
								<div class="col">
									<select name="theme" required class="form-control">
										<option  {{ old('theme', $settings->theme) == "blue" ? "selected": "" }} value="blue">Default</option>
										<option  {{ old('theme', $settings->theme) == "green" ? "selected": "" }} value="green">Green</option>
									</select>
								</div>
							</div>

							<div class="form-group mb-3 row" style="display: none;">
								<label class="form-label col-12 col-sm-3 col-form-label">Default Language</label>
								<div class="col">
									<select name="language" required class="form-control">
										<option  {{ old('language', $settings->language) == "en" ? "selected": "" }} value="en">English</option>
										<option  {{ old('language', $settings->language) == "hi" ? "selected": "" }} value="hi">Hindi</option>
									</select>
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Support Email</label>
								<div class="col">
									<input
										type="text" name="support_email"
										@if($errors->has('support_email'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('support_email', $settings->support_email) }}"
									/>
									@if($errors->has('support_email'))
										<div class="invalid-feedback">{{ $errors->first('support_email') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Support URL</label>
								<div class="col">
									<input
										type="text" name="support_url"
										@if($errors->has('support_url'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('support_url', $settings->support_url) }}"
									/>
									@if($errors->has('support_url'))
										<div class="invalid-feedback">{{ $errors->first('support_url') }}</div>
									@endif
								</div>
							</div>
							
							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Appointment URL</label>
								<div class="col">
									<input
										type="text" name="appointment_url"
										@if($errors->has('appointment_url'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('appointment_url', $settings->appointment_url) }}"
									/>
									@if($errors->has('appointment_url'))
										<div class="invalid-feedback">{{ $errors->first('appointment_url') }}</div>
									@endif
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Phone</label>
								<div class="col">
									<input
										type="text" name="phone"
										@if($errors->has('phone'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('phone', $settings->phone) }}"
									/>
									@if($errors->has('phone'))
										<div class="invalid-feedback">{{ $errors->first('phone') }}</div>
									@endif
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Maps URL</label>
								<div class="col">
									<input
										type="text" name="maps_link"
										@if($errors->has('maps_link'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('maps_link', $settings->maps_link) }}"
									/>
									@if($errors->has('maps_link'))
										<div class="invalid-feedback">{{ $errors->first('maps_link') }}</div>
									@endif
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Address</label>
								<div class="col">
									<textarea name="address"
										@if($errors->has('address'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
									>{{ old('address', $settings->address) }}</textarea>
									@if($errors->has('address'))
										<div class="invalid-feedback">{{ $errors->first('address') }}</div>
									@endif
								</div>
							</div>

							<br/>
							<b>Working Hours:</b>
							<br/>
							<br/>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Monday to - Thursday</label>
								<div class="col">
									<input
										type="text" name="working_hours_mon_thu"
										@if($errors->has('working_hours_mon_thu'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('working_hours_mon_thu', $settings->working_hours_mon_thu) }}"
									/>
									@if($errors->has('working_hours_mon_thu'))
										<div class="invalid-feedback">{{ $errors->first('working_hours_mon_thu') }}</div>
									@endif
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Friday</label>
								<div class="col">
									<input
										type="text" name="working_hours_friday"
										@if($errors->has('working_hours_friday'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('working_hours_friday', $settings->working_hours_friday) }}"
									/>
									@if($errors->has('working_hours_friday'))
										<div class="invalid-feedback">{{ $errors->first('working_hours_friday') }}</div>
									@endif
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Saturday - Sunday</label>
								<div class="col">
									<input
										type="text" name="working_hours_sat_sun"
										@if($errors->has('working_hours_sat_sun'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('working_hours_sat_sun', $settings->working_hours_sat_sun) }}"
									/>
									@if($errors->has('working_hours_sat_sun'))
										<div class="invalid-feedback">{{ $errors->first('working_hours_sat_sun') }}</div>
									@endif
								</div>
							</div>

							<br/>
							<b>Social Links:</b>
							<br/>
							<br/>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Facebook Link</label>
								<div class="col">
									<input
										type="text" name="social_link_facebook"
										@if($errors->has('social_link_facebook'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('social_link_facebook', $settings->social_link_facebook) }}"
									/>
									@if($errors->has('social_link_facebook'))
										<div class="invalid-feedback">{{ $errors->first('social_link_facebook') }}</div>
									@endif
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Instagram Link</label>
								<div class="col">
									<input
										type="text" name="social_link_instagram"
										@if($errors->has('social_link_instagram'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('social_link_instagram', $settings->social_link_instagram) }}"
									/>
									@if($errors->has('social_link_instagram'))
										<div class="invalid-feedback">{{ $errors->first('social_link_instagram') }}</div>
									@endif
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Linkedin Link</label>
								<div class="col">
									<input
										type="text" name="social_link_linkedin"
										@if($errors->has('social_link_linkedin'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('social_link_linkedin', $settings->social_link_linkedin) }}"
									/>
									@if($errors->has('social_link_linkedin'))
										<div class="invalid-feedback">{{ $errors->first('social_link_linkedin') }}</div>
									@endif
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Twitter Link</label>
								<div class="col">
									<input
										type="text" name="social_link_twitter"
										@if($errors->has('social_link_twitter'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('social_link_twitter', $settings->social_link_twitter) }}"
									/>
									@if($errors->has('social_link_twitter'))
										<div class="invalid-feedback">{{ $errors->first('social_link_twitter') }}</div>
									@endif
								</div>
							</div>

							<br/>
							<b>Top Bar:</b>
							<br/>
							<br/>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Hide Top Bar</label>
								<div class="col">
									<select
										name="hide_top_alert_bar"
										@if($errors->has('hide_top_alert_bar'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
									>
										<option value="0" @if($settings->hide_top_alert_bar == false) selected @endif>No</option>
										<option value="1" @if($settings->hide_top_alert_bar == true) selected @endif>Yes</option>
									</select>
									@if($errors->has('hide_top_alert_bar'))
										<div class="invalid-feedback">{{ $errors->first('hide_top_alert_bar') }}</div>
									@endif
								</div>
							</div>


							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Custom Text</label>
								<div class="col">
									<textarea name="custom_top_alert_bar_text"
										@if($errors->has('custom_top_alert_bar_text'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
									>{{ old('custom_top_alert_bar_text', $settings->custom_top_alert_bar_text) }}</textarea>
									@if($errors->has('custom_top_alert_bar_text'))
										<div class="invalid-feedback">{{ $errors->first('custom_top_alert_bar_text') }}</div>
									@endif
								</div>
							</div>

							<br/>
							<b>Custom Code:</b>
							<br/>
							<br/>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Analytics Code</label>
								<div class="col">
									<textarea name="analytics_code"
										@if($errors->has('analytics_code'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
									>{{ old('analytics_code', $settings->analytics_code) }}</textarea>
									@if($errors->has('analytics_code'))
										<div class="invalid-feedback">{{ $errors->first('analytics_code') }}</div>
									@endif
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Custom Style</label>
								<div class="col">
									<textarea name="custom_style"
										@if($errors->has('custom_style'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
									>{{ old('custom_style', $settings->custom_style) }}</textarea>
									@if($errors->has('custom_style'))
										<div class="invalid-feedback">{{ $errors->first('custom_style') }}</div>
									@endif
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Custom Script</label>
								<div class="col">
									<textarea name="custom_script"
										@if($errors->has('custom_script'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
									>{{ old('custom_script', $settings->custom_script) }}</textarea>
									@if($errors->has('custom_script'))
										<div class="invalid-feedback">{{ $errors->first('custom_script') }}</div>
									@endif
								</div>
							</div>

						</div>
						<div class="card-footer">
							<div class="d-flex">
								<a href="{{ route('get_admin_index') }}" class="btn btn-link">Cancel</a>
								<button type="submit" class="btn btn-success ms-auto">Save Changes</button>
							</div>
						</div>
					</form>
				</div>

				<div class="card mb-4" id="email">
					<div class="card-header">
						<h3 class="card-title">Email Setup</h3>
					</div>
					<form action="{{ route('post_admin_settings_email') }}" method="post">
						{{ csrf_field() }}
						<div class="card-body">
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">Host</label>
								<div class="col">
									<input
										type="text" required name="host"
										@if($errors->has('host'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('host', $settings->host) }}"
									/>
									@if($errors->has('host'))
										<div class="invalid-feedback">{{ $errors->first('host') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">Port</label>
								<div class="col">
									<input
										type="text" required name="port"
										@if($errors->has('port'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('port', $settings->port) }}"
									/>
									@if($errors->has('port'))
										<div class="invalid-feedback">{{ $errors->first('port') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Encryption</label>
								<div class="col">
									<select name="encryption" required class="form-control">
										<option  {{ old('encryption', $settings->encryption) == "tls" ? "selected": "" }} value="tls">TLS</option>
									</select>
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">Username</label>
								<div class="col">
									<input
										type="text" required name="username"
										@if($errors->has('username'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('username', $settings->username) }}"
									/>
									@if($errors->has('username'))
										<div class="invalid-feedback">{{ $errors->first('username') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">Password</label>
								<div class="col">
									<input
										type="text" required name="password"
										@if($errors->has('password'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('password', $settings->password) }}"
									/>
									@if($errors->has('password'))
										<div class="invalid-feedback">{{ $errors->first('password') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">From Address</label>
								<div class="col">
									<input
										type="text" required name="from_address"
										@if($errors->has('from_address'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('from_address', $settings->from_address) }}"
									/>
									@if($errors->has('from_address'))
										<div class="invalid-feedback">{{ $errors->first('from_address') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">From Name</label>
								<div class="col">
									<input
										type="text" required name="from_name"
										@if($errors->has('from_name'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('from_name', $settings->from_name) }}"
									/>
									@if($errors->has('from_name'))
										<div class="invalid-feedback">{{ $errors->first('from_name') }}</div>
									@endif
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="d-flex">
								<a href="{{ route('get_admin_index') }}" class="btn btn-link">Cancel</a>
								<div class="ms-auto">
									<a href="#" class="btn btn-outline-warning">Test Configuration</a>
									<button type="submit" class="btn btn-success">Save Changes</button>
								</div>

							</div>
						</div>
					</form>
				</div>
				@endif

				<div class="card mb-4" id="security">
					<div class="card-header">
						<h3 class="card-title">Security</h3>
					</div>
					<form action="{{ route('post_admin_settings_password') }}" method="post">
						{{ csrf_field() }}

						<div class="card-body">
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">Email</label>
								<div class="col">
									<input type="email" name="" class="form-control" disabled id=""
										value="{{ Auth::user()->email }}" />
								</div>
							</div>
							<!-- <div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Old Password</label>
								<div class="col">
									<input type="password" class="form-control" placeholder="Password">
								</div>
							</div> -->

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">New Password</label>
								<div class="col">
									<input
										type="password" name="password" required
										@if($errors->has('password'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value=""
										placeholder="Password"
									/>
									@if($errors->has('password'))
										<div class="invalid-feedback">{{ $errors->first('password') }}</div>
									@endif
									<small class="form-hint">
										Your password must be 8-20 characters long, contain letters and numbers, and
										must not contain
										spaces, special characters, or emoji.
									</small>
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Confirm Password</label>
								<div class="col">
									<input
										type="password" class="form-control" placeholder="Password" required name="password_confirm"
										@if($errors->has('password_confirm'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value=""
									/>
									@if($errors->has('password_confirm'))
										<div class="invalid-feedback">{{ $errors->first('password_confirm') }}</div>
									@endif
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="d-flex">
								<a href="{{ route('get_admin_index') }}" class="btn btn-link">Cancel</a>
								<button type="submit" class="btn btn-success ms-auto">Change Password</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection