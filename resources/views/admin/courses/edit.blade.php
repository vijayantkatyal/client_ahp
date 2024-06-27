@extends('_layouts.admin')
@section('title','Course Edit')
@section('header')

@endsection

@section('content')

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Course / #{{ $course->id }}
				</div>
				<h2 class="page-title">
					{{ $course->name }}
				</h2>
			</div>
			<!-- Page title actions -->
			<div class="col-auto ms-auto d-print-none" style="display: none;">
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
					<form action="{{ route('post_admin_course_edit', $course->id) }}" method="post">
						{{ csrf_field() }}
						<div class="card-body">
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">Name</label>
								<div class="col">
									<input
										type="text" name="name" required
										@if($errors->has('name'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('name', $course->name) }}"
									/>
									@if($errors->has('name'))
										<div class="invalid-feedback">{{ $errors->first('name') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">Description</label>
								<div class="col">
									<textarea name="description" class="form-control">{{ old('description', $course->description) }}</textarea>
									@if($errors->has('description'))
										<div class="invalid-feedback">{{ $errors->first('description') }}</div>
									@endif
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="d-flex">
								<a href="{{ route('get_admin_courses_all') }}" class="btn btn-link">Cancel</a>
								<button type="submit" class="btn btn-success ms-auto">Update</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection

@section('footer')
@endsection