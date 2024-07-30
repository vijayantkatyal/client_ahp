@extends('_layouts.admin')
@section('title','Users Edit')
@section('header')

@endsection

@section('content')

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Users / #{{ $user->id }}
				</div>
				<h2 class="page-title">
					{{ $user->first_name }} {{ $user->last_name }}
					<small class="text-muted ps-1">
						{{ $user->email }}
					</small>
				</h2>
				<div class="text-muted mt-1">
					@if($user->enabled)
					<span class="badge bg-success">Active</span>
					@else
					<span class="badge bg-danger">Disabled</span>
					@endif
					<span class="badge bg-azure">{{ $user->plan_name }}</span>
				</div>
			</div>
			<!-- Page title actions -->
			<div class="col-auto ms-auto d-print-none" style="display: none;">
				<div>
					<a href="#" class="btn btn-outline-success">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login" width="24"
							height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
							stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
							</path>
							<path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
						</svg>&nbsp;Access
					</a>
					<a href="#" class="btn btn-outline-secondary">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24"
							height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
							stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<line x1="10" y1="14" x2="21" y2="3"></line>
							<path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5">
							</path>
						</svg>&nbsp;Reset
					</a>
					<a href="#" class="btn btn-outline-warning">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24"
							height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
							stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<line x1="18" y1="6" x2="6" y2="18"></line>
							<line x1="6" y1="6" x2="18" y2="18"></line>
						</svg>&nbsp;Disable
					</a>
					<a href="#" class="btn btn-outline-danger">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24"
							height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
							stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<line x1="4" y1="7" x2="20" y2="7"></line>
							<line x1="10" y1="11" x2="10" y2="17"></line>
							<line x1="14" y1="11" x2="14" y2="17"></line>
							<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
							<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
						</svg>&nbsp;Delete
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="page-body">
	<div class="container-xl">
		<div class="row">
			<div class="col-12">
				
				@component('_layouts.components.alert')
        		@endcomponent

				<div class="card mb-4" id="general">
					
					<div class="card-header">
						<h3 class="card-title">General</h3>
					</div>
					<form action="{{ route('post_admin_users_edit', $user->id) }}" method="post">
						{{ csrf_field() }}
						<div class="card-body">
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">First Name</label>
								<div class="col">
									<input
										type="text" name="first_name" required
										@if($errors->has('first_name'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('first_name', $user->first_name) }}"
									/>
									@if($errors->has('first_name'))
										<div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">Last Name</label>
								<div class="col">
									<input
										type="text" name="last_name" required
										@if($errors->has('last_name'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('last_name', $user->last_name) }}"
									/>
									@if($errors->has('last_name'))
										<div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">Email</label>
								<div class="col">
									<input
										type="text" name="email" required
										@if($errors->has('email'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('email', $user->email) }}"
									/>
									@if($errors->has('email'))
										<div class="invalid-feedback">{{ $errors->first('email') }}</div>
									@endif
								</div>
							</div>
							
							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Plan / Level</label>
								<div class="col">
									<select name="plan_id" class="form-control">
										<option selected></option>
										@foreach($plans as $plan)
											<option {{ old('plan_id', $plan_id) == $plan->id ? "selected": "" }} value="{{ $plan->id }}">{{ $plan->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="d-flex">
								<a href="{{ route('get_admin_users_index') }}" class="btn btn-link">Cancel</a>
								<button type="submit" class="btn btn-success ms-auto">Update</button>
							</div>
						</div>
					</form>
				</div>

				@if($user->plan_name == "Teacher")

				<div class="card mb-4" id="hours_info">
					<div class="card-header">
						<div class="col">
							<h3 class="card-title">Hourly Rate</h3>
						</div>
					</div>
					<form action="{{ route('post_admin_users_edit_hourly_rate') }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="user_id" value="{{ $user->id }}"/>
						<div class="card-body">
							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Hourly Rate (CAD)</label>
								<div class="col">
									<input required type="number" min="0" step="0.5" name="hourly_rate" id="" class="form-control" value="{{ $user->hourly_rate }}"/>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="d-flex">
								<a href="{{ route('get_admin_users_index') }}" class="btn btn-link">Cancel</a>
								<button type="submit" class="btn btn-success ms-auto">Update</button>
							</div>
						</div>
					</form>
				</div>
				@endif

				@if($user->plan_name == "Board Member")

				<div class="card mb-4" id="course_info">
					<div class="card-header">
						<div class="col">
							<h3 class="card-title">Profile Pic</h3>
						</div>
					</div>
					<form action="{{ route('post_admin_users_edit_pic') }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="user_id" value="{{ $user->id }}"/>
						<div class="card-body">
							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Title</label>
								<div class="col">
									<input type="text" name="title" id="" class="form-control" value="{{ $user->title }}"/>
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Profile Pic</label>
								<div class="col">
									<img src="{{ asset($user->profile_pic) }}" alt=""/>
									<br/>
									<input type="file" name="file" id="" class="form-control" required/>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="d-flex">
								<a href="{{ route('get_admin_users_index') }}" class="btn btn-link">Cancel</a>
								<button type="submit" class="btn btn-success ms-auto">Update</button>
							</div>
						</div>
					</form>
				</div>
				@endif

				@if($user->plan_name == "Student")

				<div class="card mb-4" id="course_info">
					<div class="card-header">
						<div class="col">
							<h3 class="card-title">Course Info</h3>
						</div>
						<div class="col-auto ms-auto d-print-none">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-class">Add Class</button>
						</div>
					</div>
					@if(sizeof($user->classes_info) > 0)
					<ul class="list-group list-group-flush">
						@foreach($user->classes_info as $class_info)
							<div class="list-group-item">
								<div class="row">
									<div class="col-6">
										<b>Course: </b>{{ $class_info->course_name }} / <b>Class: </b> {{ $class_info->class_name }} ({{ $class_info->start_date }} - {{ $class_info->end_date }})
									</div>
									<div class="col-6 text-end">
										<a href="{{ route('get_remove_class_from_user', ['id' => $class_info->id]) }}" class="btn btn-sm btn-outline-danger delete_a_thing">Remove</a>
									</div>
								</div>
							</div>
						@endforeach
					</ul>
					@endif
					
				</div>
				@endif

				<div class="card mb-4" id="security">
					<div class="card-header">
						<h3 class="card-title">Security</h3>
					</div>
					<form action="{{ route('post_admin_users_password', ['id' => $user->id]) }}" method="post">
						{{ csrf_field() }}
						<div class="card-body">

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
								<a href="{{ route('get_admin_users_index') }}" class="btn btn-link">Cancel</a>
								<button type="submit" class="btn btn-success ms-auto">Change Password</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="modal modal-blur fade" id="modal-add-class" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Class to Student</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{ route('post_class_to_course') }}" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="user_id" value="{{ $user->id }}"/>
				<div class="modal-body">

					<div class="form-group mb-3 row">
						<label class="form-label col-12 col-sm-3 col-form-label">Course</label>
						<div class="col">
							<select name="course_id" id="" class="form-select" required>
								@if($user->course_id == null)
									<option value=""></option>
								@endif
								@foreach($courses as $course)
									<option value="{{ $course->id }}">{{ $course->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group mb-3 row">
						<label class="form-label col-12 col-sm-3 col-form-label">Class</label>
						<div class="col">
							<select name="class_id" id="" class="form-select" required>
								@foreach($classes as $class)
									<option value="{{ $class->id }}">{{ $class->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="d-flex">
						<a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
							Cancel
						</a>
						<button type="submit" class="btn btn-success ms-auto">Update</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('footer')
	<script>
		$("select[name=course_id]").val("{{ $user->course_id }}");
		$("select[name=class_id]").val("{{ $user->class_id }}");

		$("select[name=course_id]").change(function(){
			var _id = $("select[name=course_id]").find(":selected").val();

			$("select[name=class_id]").empty();

			$.getJSON("{{ route('get_classes_by_course_id') }}?id="+_id).then(function(data){
				console.log(data);
				var _data = '';

				
				data.forEach(function(item){
					_data += "<option value='"+ item.id +"'>"+ item.name + " ("+ item.start_date + " - " + item.end_date +")" +"</option>";
				});

				$("select[name=class_id]").append(_data);
			});
		});
	</script>
@endsection