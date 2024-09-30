@extends('_layouts.admin')
@section('title','School Calendar')
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
						School Calendar
					</h2>
					<div class="text-muted mt-1">{{ sizeof($events) }} events</div>
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
							New Event
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
										<th>
											Date
											<svg xmlns="http://www.w3.org/2000/svg"
												class="icon icon-sm text-dark icon-thick" width="24" height="24"
												viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
												stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none" />
												<polyline points="6 15 12 9 18 15" />
											</svg>
										</th>
										<th>School Activity</th>
										<th># of classes</th>
										<th>Program / Activity, if any</th>
										<th class="w-1"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($events as $event)
										<tr>
											<td>
												<div class="d-flex py-1 align-items-center">
													{{ $event->date }}
												</div>
											</td>
											<td>
                                                {{ $event->school_activity }}
											</td>
											<td>
                                                {{ $event->no_of_classes }}
											</td>
											<td>
                                                {{ $event->activity }}
											</td>
											<td>
												<div class="btn-list flex-nowrap">
													<a href="{{ route('get_admin_school_calendar_event_edit', ['id' => $event->id]) }}" class="btn btn-white">
														Edit
													</a>
													<div class="dropdown">
														<button class="btn dropdown-toggle align-text-top"
															data-bs-boundary="viewport"
															data-bs-toggle="dropdown">Actions</button>
														<div class="dropdown-menu dropdown-menu-end">
															@if($event->school_activity == "Field Trip")
																<a href="{{ route('get_admin_school_calendar_event_attendance', ['id' => $event->id]) }}" class="dropdown-item">
																	<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>&nbsp;Attendance
																</a>
															@endif
															<button class="dropdown-item text-red delete_event" data-id="{{ $event->id }}">
																<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
																	<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
																	<line x1="4" y1="7" x2="20" y2="7"></line>
																	<line x1="10" y1="11" x2="10" y2="17"></line>
																	<line x1="14" y1="11" x2="14" y2="17"></line>
																	<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
																	<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
																</svg>&nbsp;Delete
															</button>
															<form id="delete-user-{{ $event->id }}" action="{{ route('post_admin_school_calendar_event_delete', ['id' => $event->id]) }}" method="POST" style="display: none;">
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
					<h5 class="modal-title">New Event</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('post_admin_school_calendar_event') }}" method="POST">
					{{ csrf_field() }}
					<div class="modal-body">
						@component('_layouts.components.alert')
						@endcomponent

						<div class="mb-3">
							<label class="form-label">Date</label>
							<input type="date" name="date" required placeholder="Date"
								@if($errors->has('date'))
									class="form-control is-invalid"
								@else
									class="form-control"
								@endif
								value="{{ old('date') }}"
							>
							@if($errors->has('date'))
								<div class="invalid-feedback">{{ $errors->first('date') }}</div>
							@endif
						</div>

						<div class="mb-3">
							<label class="form-label">School Activity</label>
							<select class="form-control" name="school_activity" required>
                                <option value="Registration">Registration</option>
                                <option value="Regular Classes">Regular Classes</option>
                                <option value="No Classes">No Classes</option>
                                <option value="Mid Term Exam">Mid Term Exam</option>
                                <option value="Final Exam">Final Exam</option>
                                <option value="Field Trip">Field Trip</option>
                                <option value="Graduation Ceremony">Graduation Ceremony</option>
                            </select>
						</div>

                        <div class="mb-3">
							<label class="form-label"># of Classes</label>
							<select class="form-control" name="no_of_classes" required>
                                <option value="Thanksgiving wknd">Thanksgiving wknd</option>
                                <option value="Remembrance Day">Remembrance Day</option>
                                <option value="Winter break">Winter break</option>
                                <option value="Family Day/Field trip*">Family Day/Field trip*</option>
                                <option value="Good Friday wknd">Good Friday wknd</option>
                                <option value="Victoria day wknd">Victoria day wknd</option>
                                @for($i = 1; $i < 35; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
						</div>

                        <div class="mb-3">
							<label class="form-label">Program / activity, if any</label>
							<input type="text" name="activity" placeholder="Program/activity, if any" class="form-control" value="" />
						</div>

					</div>
					<div class="modal-footer">
						<a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
							Cancel
						</a>
						<button type="submit" class="btn btn-success ms-auto">
							Create
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
				$("#change-class-users input[name=users_id]").val(_selected_users);

				$("#del_users_btn").show();
				$("#change-plan-users").show();
				$("#change-class-users").show();
			}
			else
			{
				$("#del_users_btn").hide();
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
		$(".delete_event").click(function(){
    
			var answer = confirm("Do you want to do this?");
				
			if(!answer) {
				e.preventDefault();
			}

			var _id = $(this).attr("data-id");

			document.getElementById('delete-user-'+_id).submit();
		})
	</script>

@endsection