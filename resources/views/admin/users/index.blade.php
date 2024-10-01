@extends('_layouts.admin')
@section('title','Users')
@section('header')

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.12.0/css/buttons.bootstrap5.min.css">

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
						{{ $filter }}
					</h2>
					<div class="text-muted mt-1">{{ sizeof($users) }} people</div>
				</div>
				<!-- Page title actions -->
				<div class="col-auto ms-auto d-print-none">
					<div class="d-flex">

					@if($filter == "Student(s)")
						<form id="change-class-users" class="me-1" action="{{ route('post_admin_users_class_multiple') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
							<input type="text" name="users_id" style="display: none;" />
							<div class="input-group">
								<span class="input-group-text">Add to Class</span>
								<select name="new_plan_id" class="form-select" id="" style="min-width: 150px;">
									@foreach($classes as $class)
										<option value="{{ $class->course_id }}--{{ $class->id }}">{{ $class->course_name }} / {{ $class->name }} ({{ $class->start_date }} - {{ $class->end_date }})</option>
									@endforeach
								</select>
								<button class="btn btn-success" type="submit">Submit</button>
							</div>
						</form>
						@else

						<form id="change-plan-users" class="me-1" action="{{ route('post_admin_users_plan_multiple') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
							<input type="text" name="users_id" style="display: none;" />
							<div class="input-group">
								<span class="input-group-text">Change Type to</span>
								<select name="new_plan_id" class="form-select" id="" style="min-width: 150px;">
									@foreach($plans as $plan)
										<option value="{{ $plan->id }}">{{ $plan->name }}</option>
									@endforeach
								</select>
								<button class="btn btn-success" type="submit">Submit</button>
							</div>
						</form>
						@endif
					
						<button style="display: none;" id="disable_users_btn" class="btn btn-outline-danger me-1">
							<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-key-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.17 6.159l2.316 -2.316a2.877 2.877 0 0 1 4.069 0l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.33 2.33" /><path d="M14.931 14.948a2.863 2.863 0 0 1 -1.486 -.79l-.301 -.302l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.863 2.863 0 0 1 -.794 -1.504" /><path d="M15 9h.01" /><path d="M3 3l18 18" /></svg>&nbsp;Disable Selected
						</button>
						<form id="disable-users" action="{{ route('post_admin_users_disable_multiple') }}" method="POST" style="display: none;">
							<input type="text" name="users_id" />
							{{ csrf_field() }}
						</form>

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

						<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-new-user">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
								stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
								stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								<line x1="12" y1="5" x2="12" y2="19"></line>
								<line x1="5" y1="12" x2="19" y2="12"></line>
							</svg>
							New user
						</a>
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
										<th>Phone</th>
										<th>Type</th>
										<th>Status</th>
										<th>Added on</th>
										<th class="w-1"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $user)
										<tr>
											<td>
												<input class="form-check-input m-0 align-middle select_user" type="checkbox" aria-label="Select User" data-id="{{ $user->id }}">
											</td>
											<td>
												<div class="d-flex py-1 align-items-center">
													<span class="avatar me-2">
														@if($user->profile_pic)
														<img src="{{ asset($user->profile_pic) }}" class="img-fluid rounded" alt="">
														@else
														{{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
														@endif
													</span>
													<div class="flex-fill">
														<div class="font-weight-medium text-capitalize">{{ $user->first_name }} {{ $user->last_name }}</div>
														<div class="text-muted">
															<a href="#" class="text-reset">{{ $user->email }}</a>
														</div>
														@foreach($user->classes as $class_info)
															<span class="badge bg-green-lt">{{ $class_info }}</span>
														@endforeach
													</div>
												</div>
											</td>
											<td>
												{{ $user->phone }}
											</td>
											<td>
												@if($user->plan_name != null && $user->owner_details == null)
												<span class="badge bg-green-lt">{{ $user->plan_name }}</span>
												@endif
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
												<div class="btn-list flex-nowrap">
													<a href="{{ route('get_admin_users_edit', ['id' => $user->id]) }}" class="btn btn-white">
														Edit
													</a>
													<div class="dropdown">
														<button class="btn dropdown-toggle align-text-top"
															data-bs-boundary="viewport"
															data-bs-toggle="dropdown">Actions</button>
														<div class="dropdown-menu dropdown-menu-end">
															<button class="dropdown-item send_message" data-id="{{ $user->id }}" data-username="{{ $user->first_name }} {{ $user->last_name }}" data-email="{{ $user->email }}">
																<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>&nbsp;Send Message
															</button>
															<button class="dropdown-item" onclick="event.preventDefault();document.getElementById('access-user-{{ $user->id }}').submit();">
																<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
																	<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
																	<path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
																	<path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
																</svg>&nbsp;Access
															</button>
															<form id="access-user-{{ $user->id }}" action="{{ route('post_admin_users_access', $user->id) }}" method="POST" style="display: none;">
																{{ csrf_field() }}
															</form>
															<button class="dropdown-item" type="button" title="Reset and Send New Login Credentials" onclick="event.preventDefault();document.getElementById('reset-user-{{ $user->id }}').submit();">
																<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
																	<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
																	<line x1="10" y1="14" x2="21" y2="3"></line>
																	<path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5"></path>
																</svg>&nbsp;Reset
															</button>
															<form id="reset-user-{{ $user->id }}" action="{{ route('post_admin_users_reset', $user->id) }}" method="POST" style="display: none;">
																{{ csrf_field() }}
															</form>
															<button type="button" class="dropdown-item" onclick="event.preventDefault();document.getElementById('change-user-status-{{ $user->id }}').submit();">
																@if($user->enabled)
																<span class="text-danger">
																	<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
																		<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
																		<line x1="18" y1="6" x2="6" y2="18"></line>
																		<line x1="6" y1="6" x2="18" y2="18"></line>
																	</svg>&nbsp;Disable
																</span>
																@else
																<span class="text-success">
																	<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
																		<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
																		<path d="M5 12l5 5l10 -10"></path>
																	</svg>&nbsp;Enable
																</span>
																@endif
															</button>
															<form id="change-user-status-{{ $user->id }}" action="{{ route('post_admin_users_edit_status', $user->id) }}" method="POST" style="display: none;">
																{{ csrf_field() }}
																@if($user->enabled)
																	<input type="hidden" name="enabled" value="0">
																@else
																	<input type="hidden" name="enabled" value="1">
																@endif
															</form>
															<button class="dropdown-item text-red" onclick="event.preventDefault();document.getElementById('delete-user-{{ $user->id }}').submit();">
																<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
																	<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
																	<line x1="4" y1="7" x2="20" y2="7"></line>
																	<line x1="10" y1="11" x2="10" y2="17"></line>
																	<line x1="14" y1="11" x2="14" y2="17"></line>
																	<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
																	<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
																</svg>&nbsp;Delete
															</button>
															<form id="delete-user-{{ $user->id }}" action="{{ route('post_admin_users_delete', $user->id) }}" method="POST" style="display: none;">
																{{ csrf_field() }}
															</form>
														</div>
													</div>
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
								type="text" name="password" required placeholder="User Password"
								@if($errors->has('password'))
									class="form-control is-invalid"
								@else
									class="form-control"
								@endif
								value="{{ base64_encode(openssl_random_pseudo_bytes(3 * (14 >> 2))) }}"
							>
							@if($errors->has('password'))
								<div class="invalid-feedback">{{ $errors->first('password') }}</div>
							@endif
						</div>

						<div class="mb-3">
							<label class="form-label">Type</label>
							<select name="plan_id" required id=""
								@if($errors->has('plan_id'))
									class="form-control is-invalid"
								@else
									class="form-control"
								@endif
							>
								@foreach($plans as $plan)
									<option value="{{ $plan->id }}">{{ $plan->name }}</option>
								@endforeach
							</select>
							@if($errors->has('plan_id'))
								<div class="invalid-feedback">{{ $errors->first('plan_id') }}</div>
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

	<div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="sendMessageModalLabel">Send Message</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('post_admin_send_mail_to_user') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" id="sm_modal_id" name="user_id" required/>
					<div class="modal-body">
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">To</label>
							<b class="text-muted"><span id="sm_modal_name"></span> (<span id="sm_modal_email"></span>)</b>
						</div>
						<div class="mb-3">
							<label class="form-label">Subject</label>
							<input type="subject" name="subject" required class="form-control"/>
						</div>
						<div class="mb-3">
							<label class="form-label">Body</label>
							<textarea name="body" required class="form-control" rows="6"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Send</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection

@section('footer')

	<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
	
	<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>


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
			dom: 'B<"card-body"<"d-flex"<l><"ms-auto"f>>>rt<"card-body"<"d-flex"<i><"ms-auto"p>>><"clear">',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
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
				$("#disable-users input[name=users_id]").val(_selected_users);
				$("#change-plan-users input[name=users_id]").val(_selected_users);
				$("#change-class-users input[name=users_id]").val(_selected_users);

				$("#del_users_btn").show();
				$("#disable_users_btn").show();
				$("#change-plan-users").show();
				$("#change-class-users").show();
			}
			else
			{
				$("#del_users_btn").hide();
				$("#disable_users_btn").hide();
				$("#change-plan-users").hide();
				$("#change-class-users").hide();
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

	<script>
		$("#disable_users_btn").click(function(){
			var result = confirm("Want to disable?");
			if(result)
			{
				event.preventDefault();
				document.getElementById('disable-users').submit();
			}
		});
	</script>

	<script>
		$(".send_message").click(function(){
			var _id = $(this).attr("data-id");
			var _name = $(this).attr("data-username");
			var _email = $(this).attr("data-email");

			// alert(_id + " " + _name + " " + _email);

			$("#sm_modal_id").val(_id);
			$("#sm_modal_name").text(_name);
			$("#sm_modal_email").text(_email);

			const myModalAlternative = new bootstrap.Modal('#sendMessageModal');
			myModalAlternative.show();

		});
	</script>

@endsection