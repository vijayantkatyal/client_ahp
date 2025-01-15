@extends('_layouts.admin')
@section('title','Pages')
@section('content')

	<!-- header -->
	<div class="container-xl">
		<!-- Page title -->
		<div class="page-header d-print-none">
			<div class="row align-items-center">
				<div class="col">
					<h2 class="page-title">
						Pages
					</h2>
				</div>
				<!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
					<div class="d-flex">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-new-user">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
								stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
								stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								<line x1="12" y1="5" x2="12" y2="19"></line>
								<line x1="5" y1="12" x2="19" y2="12"></line>
							</svg>
							New Page
						</a>
                    </div>
                </div>
			</div>
		</div>
	</div>

	<!-- content -->
	<div class="page-body">
		<div class="container-xl">

			@component('_layouts.components.alert')
			@endcomponent

			<div class="card">
				<table class="table card-body mb-0">
					<thead>
						<tr>
							<th>Name</th>
							<th>Type</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pages as $page)
						<tr>
							<td class="p-3"><b>{{ $page->name }}</b></td>
							<td class="p-3 ps-0 text-capitalize">{{ $page->type }}</td>
							<td class="text-center">
								<a href="{{ route('get_edit_page', ['id' => $page->id]) }}" class="btn btn-primary">Edit</a>
								@if($page->type != "custom")
								<a href="{{ route('get_delete_page', ['id' => $page->id]) }}" class="btn btn-danger delete_confirm_link">Delete</a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		</div>
	</div>

    <div class="modal modal-blur fade" id="modal-new-user" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">New Page</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('post_admin_page') }}" method="POST">
					{{ csrf_field() }}
					<div class="modal-body">
						@component('_layouts.components.alert')
						@endcomponent
						<div class="row">
							<div class="col-12">
								<div class="mb-3">
									<label class="form-label">Name</label>
									<input
										type="text" name="name" required placeholder="Name" pattern="[A-Za-z0-9]+"
										@if($errors->has('name'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('name') }}"
									>
									@if($errors->has('name'))
										<div class="invalid-feedback">{{ $errors->first('name') }}</div>
									@endif
								</div>
							</div>
						</div>

                        <div class="mb-3">
							<label class="form-label">Type</label>
							<select name="type" required
								@if($errors->has('email'))
									class="form-control is-invalid"
								@else
									class="form-control"
								@endif
							>
                                <option value="general">General</option>
                                <option value="service">Service</option>
                            </select>
						</div>

						<div class="mb-3">
							<label class="form-label">Show in Top Menu</label>
							<select name="show_in_top_menu" required
								@if($errors->has('show_in_top_menu'))
									class="form-control is-invalid"
								@else
									class="form-control"
								@endif
							>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
						</div>

                        <div class="mb-3">
							<label class="form-label">Show in Footer</label>
							<select name="show_in_footer" required
								@if($errors->has('show_in_footer'))
									class="form-control is-invalid"
								@else
									class="form-control"
								@endif
							>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
						</div>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
							Cancel
						</a>
						<button type="submit" class="btn btn-success ms-auto">
							Create Page
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection

@section('footer')

@endsection