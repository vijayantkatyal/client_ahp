@extends('_layouts.staff')
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
				<div class="text-muted mt-1">Settings</div>
			</div>
		</div>
	</div>
</div>

<div class="page-body">
	<div class="container-xl">
		<div class="row">
			<div class="d-none d-lg-block col-lg-3">
				<div class="list-group bg-white" id="settings-list">
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

				<div class="card mb-4" id="security">
					<div class="card-header">
						<h3 class="card-title">Security</h3>
					</div>
					<form action="{{ route('post_staff_settings_password') }}" method="post">
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
								<a href="{{ route('get_staff_index') }}" class="btn btn-link">Cancel</a>
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