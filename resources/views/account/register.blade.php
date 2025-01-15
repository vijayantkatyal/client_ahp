@extends('_layouts.account')

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
				<div class="card-body">
                    <h2 class="card-title text-center mb-4">Register</h2>
					<div class="mb-3">
						<label class="form-label">First Name</label>
						<input
							type="text" name="first_name" required placeholder=""
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
							type="text" name="last_name" placeholder="" required
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
							type="email" required name="email" placeholder="Enter email"
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
					<div class="mb-3">
						<label class="form-label">Phone</label>
						<input
							type="text" pattern="\d*" maxlength="10" name="phone" placeholder="Enter phone"
							value="{{ old('phone') }}"
							@if($errors->has('phone'))
								class="form-control is-invalid"
							@else
								class="form-control"
							@endif
						/>
						@if($errors->has('phone'))
							<div class="invalid-feedback">{{ $errors->first('phone') }}</div>
						@endif
					</div>
					<div class="mb-3">
						<label class="form-label">
							Password
						</label>
						<input
							type="password" required name="password" placeholder="Password"
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
					<div class="mb-2">
						<label class="form-label">Type</label>
						<select required name="plan_id" class="form-control" id="">
							<option value="2">Board Member</option>
							<option value="3">Principal</option>
							<option value="4">Teacher</option>
							<option value="5" selected>Student</option>
							<option value="6">Member</option>
						</select>
					</div>

					<br/>

					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="exampleCheck1" required/>
						<label class="form-check-label" style="margin-top: 0px;" for="exampleCheck1">I Accept <a target="_blank" href="{{ route('get_terms',['type' => 'signup']) }}">Terms & Conditions</a>.</label>
					</div>

					<div class="form-footer">
						<button type="submit" class="btn btn-primary w-100">Sign Up</button>
					</div>
				</div>
			</form>
			<div class="text-center mt-3">
				<a href="{{ route('get_admin_login_route') }}" class="btn btn-link">Already have account ? Sign In</a>
				<br/><br/>
				<a href="{{ route('get_form_membership') }}" class="btn btn-primary">Member Registration Form</a>
				<a href="{{ route('get_form_registration') }}" class="btn btn-primary">Student Registration Form</a>
			</div>
		</div>
	</div>
@endsection