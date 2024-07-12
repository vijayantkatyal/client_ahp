@extends('_layouts.admin')
@section('title','Classes')
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
						Classes
					</h2>
					<div class="text-muted mt-1">{{ sizeof($classes) }} classes</div>
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
						<form id="delete-users" action="{{ route('post_admin_classes_delete_multiple') }}" method="POST" style="display: none;">
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
							New Class
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
                                        <th>Course Name</th>
										<th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Assigned Teacher(s)</th>
										<th>Added on</th>
										<th class="w-1"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($classes as $user)
										<tr>
											<td>
												<input class="form-check-input m-0 align-middle select_user" type="checkbox" aria-label="Select User" data-id="{{ $user->id }}">
											</td>
											<td>
												<div class="d-flex py-1 align-items-center">
													<span class="avatar me-2">
														{{ substr($user->name, 0, 1) }}
													</span>
													<div class="flex-fill">
														<div class="font-weight-medium text-capitalize">{{ $user->name }}</div>
													</div>
												</div>
											</td>
											<td>{{ $user->course_name }}</td>
                                            <td>{{ $user->start_date }}</td>
                                            <td>{{ $user->end_date }}</td>
                                            <td>
												@if($user->assigned_member_id != null)
													@foreach($user->assigned_member_id as $teacher_info)
														<a href="{{ route('get_admin_users_edit', ['id' => $teacher_info->id]) }}" class="btn btn-outline-secondary">{{ $teacher_info->first_name }} {{ $teacher_info->last_name }}</a>
													@endforeach
												@endif
											</td>
											<td class="moment_time">
												{{ $user->added_on }}
											</td>
											<td>
												<div class="dropdown">
													<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
													</button>
													<ul class="dropdown-menu">
														<li><a class="dropdown-item" href="{{ route('get_admin_class_resources', ['id' => $user->id]) }}">Resources</a></li>
														<li><a class="dropdown-item" href="{{ route('get_admin_class_assignments', ['id' => $user->id]) }}">Assignments</a></li>
														<li><a class="dropdown-item" href="{{ route('get_admin_class_attendance', ['id' => $user->id]) }}">Students Attendance</a></li>
														<li><a class="dropdown-item" href="{{ route('get_admin_staff_class_attendance', ['id' => $user->id]) }}">Teachers Attendance</a></li>
														<li><a class="dropdown-item" href="{{ route('get_admin_class_manage', ['id' => $user->id]) }}">Manage</a></li>
														<li><a class="dropdown-item" href="{{ route('get_admin_class_edit', ['id' => $user->id]) }}">Edit</a></li>
													</ul>
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
					<h5 class="modal-title">New Class</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('post_admin_class') }}" method="POST">
					{{ csrf_field() }}
					<div class="modal-body">
						@component('_layouts.components.alert')
						@endcomponent
						<div class="row">
							<div class="col-lg-12">
								<div class="mb-3">
									<label class="form-label">Class name</label>
									<input
										type="text" name="name" required placeholder="Name"
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
                                <div class="mb-3">
									<label class="form-label">Select Course</label>
                                    <select required name="course_id" class="form-select" id="">
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
								</div>
                                <div class="mb-3">
									<label class="form-label">Start Date (optional)</label>
									<input
										type="date" name="start_date" placeholder="Start Date"
										@if($errors->has('start_date'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('start_date') }}"
									>
									@if($errors->has('start_date'))
										<div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
									@endif
								</div>
                                <div class="mb-3">
									<label class="form-label">End Date (optional)</label>
									<input
										type="date" name="end_date" placeholder=""
										@if($errors->has('end_date'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('end_date') }}"
									>
									@if($errors->has('end_date'))
										<div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
									@endif
								</div>
                                <div class="mb-3">
									<label class="form-label">Assign Teacher(s) (optional)</label>
									<select name="assigned_member_id[]" class="form-select" multiple id="">
										<option selected></option>
										@foreach($teachers as $teacher)
											<option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }} ({{ $teacher->email }})</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
							Cancel
						</a>
						<button type="submit" class="btn btn-success ms-auto">
							Create Class
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script>
        $(".moment_time").each(function(){
            var _e_time = $(this).text();
            var _time = moment.unix(_e_time);
            var _title = _time.format("DD-MMMM-YYYY h:mm:ss a");
            $(this).attr("title", _title);
            $(this).text(_time.fromNow());
        });
    </script>

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