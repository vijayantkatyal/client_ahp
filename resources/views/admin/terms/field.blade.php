@extends('_layouts.admin')
@section('title','Field Trip Terms')
@section('header')

@endsection

@section('content')

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Terms
				</div>
				<h2 class="page-title">
					Field Trip
				</h2>
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
					<form action="{{ route('post_admin_terms', ['type' => 'field']) }}" method="post">
						{{ csrf_field() }}
						<div class="card-body">
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-12 col-form-label">Title</label>
								<div class="col-12">
									<input
										type="text" name="title" required
										@if($errors->has('title'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('title', $term->title) }}"
									/>
									@if($errors->has('title'))
										<div class="invalid-feedback">{{ $errors->first('title') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-12 col-form-label">Description</label>
								<div class="col-12">
									<textarea name="description" class="form-control" rows="10" required>{{ old('terms', $term->terms) }}</textarea>
									@if($errors->has('terms'))
										<div class="invalid-feedback">{{ $errors->first('terms') }}</div>
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