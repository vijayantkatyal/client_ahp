@extends('_layouts.account')

@section('title','Verify')

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

			<form class="card card-md" action="{{ route('post_admin_verify_route') }}" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="login_type" value="admin"/>
				<div class="card-body">
					<h2 class="card-title text-center mb-4">Verify Account</h2>
					<div class="mb-3">
						<label class="form-label">Email address</label>
						<input
							type="email" name="email" placeholder="Enter email" required
							value="{{ $email }}"
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
							Code
						</label>
						<input
							type="text" name="code" placeholder="Code" value="{{ $code }}" required
							@if($errors->has('code'))
								class="form-control is-invalid"
							@else
								class="form-control"
							@endif
						/>
					</div>
					<div class="form-footer">
						<button type="submit" class="btn btn-primary w-100">Verify</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection