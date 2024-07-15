@extends('_layouts.admin')
@section('title','Class Students')
@section('header')

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css"/>

<style>
	.table-responsive {
		overflow-x: visible;
	}
</style>

@endsection

@section('content')

	<div class="container-xl">
		<!-- Page title -->
		<div class="page-header d-print-none">
			<div class="row align-items-center">
				<div class="col">
					<h2 class="page-title">
						{{ $class->name }} / Students
					</h2>
					<div class="text-muted mt-1">{{ sizeof($students) }} students</div>
				</div>
				<!-- Page title actions -->
				<div class="col-auto ms-auto d-print-none">
					<div class="d-flex">
					
						<button style="display: none;" id="del_users_btn" class="btn btn-danger me-1">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								<line x1="4" y1="7" x2="20" y2="7"></line>
								<line x1="10" y1="11" x2="10" y2="17"></line>
								<line x1="14" y1="11" x2="14" y2="17"></line>
								<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
								<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
							</svg>&nbsp;Delete Selected
						</button>
						<form id="delete-users" action="{{ route('post_admin_users_delete_multiple') }}" method="POST" style="display: none;">
							<input type="text" name="users_id" />
							{{ csrf_field() }}
						</form>

                        <a href="{{ route('get_admin_class_attendance', ['id' => $class->id]) }}" class="btn btn-outline-primary me-1">
							Attendance
						</a>

						<!-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-new-user">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
								stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
								stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								<line x1="12" y1="5" x2="12" y2="19"></line>
								<line x1="5" y1="12" x2="19" y2="12"></line>
							</svg>
							New student
						</a> -->
					</div>
				</div>
			</div>
		</div>

		<br>

		@component('_layouts.components.alert')
		@endcomponent
	</div>

	<!-- content -->
	<div class="page-body">
		<div class="container-xl">
			<div class="row row-cards">
				<div class="col-12">
					<div class="card">
						<div class="card-body border-bottom py-3" style="display: none;">
							<div class="d-flex">
								<div class="text-muted">
									Show
									<div class="mx-2 d-inline-block">
										<input type="text" class="form-control form-control-sm" value="8" size="3"
											aria-label="Invoices count">
									</div>
									entries
								</div>
								<div class="ms-auto text-muted">
									Search:
									<div class="ms-2 d-inline-block">
										<input type="text" class="form-control form-control-sm" aria-label="Search invoice">
									</div>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table card-table table-vcenter table-mobile-md datatable">
								<thead>
									<tr>
										<th class="w-1">
											<!-- <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all users"> -->
										</th>
										<th>
											Name
											<svg xmlns="http://www.w3.org/2000/svg"
												class="icon icon-sm text-dark icon-thick" width="24" height="24"
												viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
												stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none" />
												<polyline points="6 15 12 9 18 15" />
											</svg>
										</th>
										<th>Status</th>
										<th>Added on</th>
										<th>Marks</th>
										<th class="w-1"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($students as $user)
										<tr>
											<td>
												<input class="form-check-input m-0 align-middle select_user" type="checkbox" aria-label="Select User" data-id="{{ $user->id }}">
											</td>
											<td>
												<div class="d-flex py-1 align-items-center">
													<span class="avatar me-2">
														{{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
													</span>
													<div class="flex-fill">
														<div class="font-weight-medium text-capitalize">{{ $user->first_name }} {{ $user->last_name }}</div>
														<div class="text-muted">
															<a href="#" class="text-reset">{{ $user->email }}</a>
															@if($user->owner_details != null)
																<br>
																<span class="badge bg-blue-lt">Agency Sub User</span>
																<span class="badge bg-blue-lt">{{ $user->owner_details->first_name }} {{ $user->owner_details->last_name }}</span>
																<a class="badge bg-blue-lt" href="{{ url('/admin/users/edit') }}/{{ $user->owner_details->id }}">by: {{ $user->owner_details->first_name }} {{ $user->owner_details->last_name }}</a>

															@endif
															@if($user->is_agency)
																<br>
																<span class="badge bg-red-lt">Agency</span>
															@endif
														</div>
													</div>
												</div>
											</td>
											<td>
												@if($user->enabled)
												<span class="badge bg-success me-1"></span> Active
												@else
												<span class="badge bg-danger me-1"></span> Disabled
												@endif
											</td>
											<td>
												{{ $user->created_at }}
											</td>
											<td>
												{{ $user->marks_obtained }} / {{ $user->total_marks }} ({{ ($user->marks_obtained / $user->total_marks) * 100 }} %)
											</td>
											<td>
												<div class="btn-list flex-nowrap">
													<a href="{{ route('get_admin_users_edit', ['id' => $user->id]) }}" class="btn btn-white">
														Edit
													</a>
													<a href="{{ route('get_admin_users_edit', ['id' => $user->id]) }}" class="btn btn-white">
														Attendance Report
													</a>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="card-footer d-flex align-items-center" style="display: none !important;">
							<p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span> entries
							</p>
							<ul class="pagination m-0 ms-auto">
								<li class="page-item disabled">
									<a class="page-link" href="#" tabindex="-1" aria-disabled="true">
										<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
										<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
											viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
											stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<polyline points="15 6 9 12 15 18" />
										</svg>
										prev
									</a>
								</li>
								<li class="page-item"><a class="page-link" href="#">1</a></li>
								<li class="page-item active"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item"><a class="page-link" href="#">4</a></li>
								<li class="page-item"><a class="page-link" href="#">5</a></li>
								<li class="page-item">
									<a class="page-link" href="#">
										next
										<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
										<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
											viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
											stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<polyline points="9 6 15 12 9 18" />
										</svg>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal modal-blur fade" id="modal-new-user" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">New User</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('post_admin_users_add') }}" method="POST">
					{{ csrf_field() }}
					<div class="modal-body">
						@component('_layouts.components.alert')
						@endcomponent
						<div class="row">
							<div class="col-lg-6">
								<div class="mb-3">
									<label class="form-label">First name</label>
									<input
										type="text" name="first_name" required placeholder="First Name"
										@if($errors->has('first_name'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('first_name') }}"
									>
									@if($errors->has('first_name'))
										<div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
									@endif
								</div>
							</div>
							<div class="col-lg-6">
								<div class="mb-3">
									<label class="form-label">Last Name</label>
									<input
										type="text" name="last_name" required placeholder="Last Name"
										@if($errors->has('last_name'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('last_name') }}"
									>
									@if($errors->has('last_name'))
										<div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
									@endif
								</div>
							</div>
						</div>

						<div class="mb-3">
							<label class="form-label">Email</label>
							<input type="text" name="email" required placeholder="User Email"
								@if($errors->has('email'))
									class="form-control is-invalid"
								@else
									class="form-control"
								@endif
								value="{{ old('email') }}"
							>
							@if($errors->has('email'))
								<div class="invalid-feedback">{{ $errors->first('email') }}</div>
							@endif
						</div>

						<div class="mb-3">
							<label class="form-label">Password</label>
							<input
								type="password" name="password" required placeholder="User Password"
								@if($errors->has('password'))
									class="form-control is-invalid"
								@else
									class="form-control"
								@endif
								value=""
							>
							@if($errors->has('password'))
								<div class="invalid-feedback">{{ $errors->first('password') }}</div>
							@endif
						</div>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
							Cancel
						</a>
						<button type="submit" class="btn btn-success ms-auto">
							Create User
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection

@section('footer')

	<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

	<script>
		$('.datatable').DataTable({
			// dom: '<"top"i>rt<"bottom"flp><"clear">'
			'columnDefs': [{
         		'targets': 0,
         		'searchable':false,
         		'orderable':false
			}],
			'order': [4, 'desc'],
			"lengthMenu": [ [5, 10, 25, 50, 100, 500, 1000, 2000 -1], [5, 10, 25, 50, 100, 500, 1000, 2000, "All"] ],
			"pageLength": {{ config('isotopekit_admin.defaultLength') }},
			dom: '<"card-body"<"d-flex"<l><"ms-auto"f>>>rt<"card-body"<"d-flex"<i><"ms-auto"p>>><"clear">'
		});
	</script>

	<script>
		var _mode = getUrlVars()["mode"];
		if(_mode == "user_add")
		{
			var myModal = new bootstrap.Modal(document.getElementById('modal-new-user'), {
				keyboard: false
			})
			myModal.show();
		}
	</script>

	<script>

		var _selected_users = [];

		$(".select_user").change(function(){
			
			var _id = $(this).data("id");

			if($(this).is(":checked"))
			{
				_selected_users.push(_id);
			}
			else
			{
				_selected_users = _selected_users.filter(id => id !== _id);
			}

			if(_selected_users.length > 0)
			{
				$("#delete-users input[name=users_id]").val(_selected_users);
				$("#change-plan-users input[name=users_id]").val(_selected_users);

				$("#del_users_btn").show();
				$("#change-plan-users").show();
			}
			else
			{
				$("#del_users_btn").hide();
				$("#change-plan-users").hide();
			}
		});
	</script>

	<script>
		$("#del_users_btn").click(function(){
			var result = confirm("Want to delete?");
			if(result)
			{
				event.preventDefault();
				document.getElementById('delete-users').submit();
			}
		});
	</script>

@endsection