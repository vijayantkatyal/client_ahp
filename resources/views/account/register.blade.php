@extends('_layouts.guest')

@section('title','Register')

@section('content')
	<div class="page page-center">
		<div class="container-tight py-4">
			<div class="text-center mb-4">
				<a href="/" class="h1">
					{{ config('isotopekit_admin.app_name') }}
				</a>
			</div>
			
			@component('_layouts.components.alert')
        	@endcomponent

			<form class="card card-md" action="{{ route('post_register_route') }}" method="post">
				{{ csrf_field() }}
                <input type="hidden" name="plan_id" value="2">
				<div class="card-body">
                    <h2 class="card-title text-center mb-4">Register as Student</h2>
					<div class="mb-3">
						<label class="form-label">First Name</label>
						<input
							type="text" name="first_name" placeholder=""
							value="{{ old('first_name') }}"
							@if($errors->has('first_name'))
								class="form-control is-invalid"
							@else
								class="form-control"
							@endif
						/>
						@if($errors->has('first_name'))
							<div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
						@endif
					</div>
                    <div class="mb-3">
						<label class="form-label">Last Name</label>
						<input
							type="text" name="last_name" placeholder=""
							value="{{ old('last_name') }}"
							@if($errors->has('last_name'))
								class="form-control is-invalid"
							@else
								class="form-control"
							@endif
						/>
						@if($errors->has('last_name'))
							<div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
						@endif
					</div>
					<div class="mb-3">
						<label class="form-label">Email address</label>
						<input
							type="email" name="email" placeholder="Enter email"
							value="{{ old('email') }}"
							@if($errors->has('email'))
								class="form-control is-invalid"
							@else
								class="form-control"
							@endif
						/>
						@if($errors->has('email'))
							<div class="invalid-feedback">{{ $errors->first('email') }}</div>
						@endif
					</div>
					<div class="mb-2">
						<label class="form-label">
							Password
						</label>
						<input
							type="password" name="password" placeholder="Password"
							@if($errors->has('password'))
								class="form-control is-invalid"
							@else
								class="form-control"
							@endif
						/>
						@if ($errors->has('password'))
							<div class="invalid-feedback">{{ $errors->first('password') }}</div>
						@endif
					</div>
					<div class="form-footer">
						<button type="submit" class="btn btn-primary w-100">Sign Up</button>
					</div>
				</div>
			</form>
			<div class="text-center mt-3">
				<a href="{{ route('get_admin_login_route') }}" class="btn btn-link">Already have account ? Sign In</a>
			</div>
		</div>
	</div>
@endsection