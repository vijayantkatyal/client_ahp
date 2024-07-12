@extends('_layouts.admin')
@section('title','Class Teachers Attendance')
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
						{{ $class->name }} / Teachers Attendance
					</h2>
					<div class="text-muted mt-1">{{ sizeof($students) }} teachers</div>
				</div>
				<!-- Page title actions -->
				<div class="col-auto ms-auto d-print-none">
					<div class="d-flex">
						<a href="#" class="btn btn-primary">
							<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
							Download Attendance (PDF)
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
											Name
											<svg xmlns="http://www.w3.org/2000/svg"
												class="icon icon-sm text-dark icon-thick" width="24" height="24"
												viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
												stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none" />
												<polyline points="6 15 12 9 18 15" />
											</svg>
										</th>
										@foreach($days as $day)
											<th class="text-center">{{ $day['day'] }} ({{ $day['date'] }})</th>
										@endforeach
									</tr>
								</thead>
								<tbody>
									@foreach($students as $user)
										<tr>
											<td>
												<div class="d-flex py-1 align-items-center">
													<span class="avatar me-2">
														{{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
													</span>
													<div class="flex-fill">
														<div class="font-weight-medium text-capitalize">{{ $user->first_name }} {{ $user->last_name }}</div>
														<div class="text-muted">
															<a href="#" class="text-reset">{{ $user->email }}</a>
														</div>
													</div>
												</div>
											</td>
											@foreach($days as $day)
											<td class="text-center">
												<span class="user_attendance" data-user-id="{{ $user->id }}" data-date="{{ $day['date'] }}"></span>
                                                <!-- <span class="text-success">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                                </span> -->
											</td>
                                            @endforeach
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

	<script>
		$(".user_attendance").each(function(key, item){
			var _item = $(item)[0];
			console.log(_item);
			var _user_id = _item.dataset.userId;
			var _date_id = _item.dataset.date;
			var _class_id = "{{ $class->id }}";

			console.log(_class_id);
			console.log(_user_id + " : " + _date_id);

			$.getJSON("{{ route('get_amin_class_attendance_single') }}?user_id="+_user_id+"&class_id="+_class_id+"&date="+_date_id).done(function(resp){
				console.log(resp);
				if(resp == null)
				{
					var _body = `<div class="btn-group" role="group" aria-label="">
						<button data-user-id="`+ _user_id +`" data-date="`+ _date_id +`" data-present="true" type="button" class="mark_attendance btn btn-outline-success"><svg  xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg></button>
						<button data-user-id="`+ _user_id +`" data-date="`+ _date_id +`" data-present="false" type="button" class="mark_attendance btn btn-outline-danger"><svg  xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
					</div>`;
					$(_item).append(_body);
				}
				else
				{
					if(resp.present == true)
					{
						$(_item).append(`
							<div class="btn-group" role="group" aria-label="">
								<button data-user-id="`+ _user_id +`" data-date="`+ _date_id +`" data-present="true" type="button" class="mark_attendance btn btn-success"><svg  xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg></button>
								<button data-user-id="`+ _user_id +`" data-date="`+ _date_id +`" data-present="false" type="button" class="mark_attendance btn btn-outline-danger"><svg  xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
							</div>
						`);	
					}
					if(resp.present == false)
					{
						$(_item).append(`
							<div class="btn-group" role="group" aria-label="">
								<button data-user-id="`+ _user_id +`" data-date="`+ _date_id +`" data-present="true" type="button" class="mark_attendance btn btn-outline-success"><svg  xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg></button>
								<button data-user-id="`+ _user_id +`" data-date="`+ _date_id +`" data-present="false" type="button" class="mark_attendance btn btn-danger"><svg  xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
							</div>
						`);
					}
				}
			});
		})
	</script>

	<script>
		$("body").on("click", ".mark_attendance", function(){
			var _item = $(this)[0];
			console.log(_item);
			var _user_id = _item.dataset.userId;
			var _date_id = _item.dataset.date;
			var _class_id = "{{ $class->id }}";
			var _present = _item.dataset.present;

			$.post("{{ route('post_amin_class_attendance_single') }}", {
				"_token": "{{ csrf_token() }}",
				"user_id": _user_id,
				"date_id": _date_id,
				"class_id": _class_id,
				"present": _present
			}).done(function(resp){
				console.log(resp);

				var _parent = $(_item).parents(".user_attendance");

				$(_parent).empty();				

				if(_present == "true")
				{
					$(_parent).append(`
						<div class="btn-group" role="group" aria-label="">
							<button data-user-id="`+ _user_id +`" data-date="`+ _date_id +`" data-present="true" type="button" class="mark_attendance btn btn-success"><svg  xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg></button>
							<button data-user-id="`+ _user_id +`" data-date="`+ _date_id +`" data-present="false" type="button" class="mark_attendance btn btn-outline-danger"><svg  xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
						</div>
					`);	
				}

				if(_present == "false")
				{
					$(_parent).append(`
						<div class="btn-group" role="group" aria-label="">
							<button data-user-id="`+ _user_id +`" data-date="`+ _date_id +`" data-present="true" type="button" class="mark_attendance btn btn-outline-success"><svg  xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg></button>
							<button data-user-id="`+ _user_id +`" data-date="`+ _date_id +`" data-present="false" type="button" class="mark_attendance btn btn-danger"><svg  xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></button>
						</div>
					`);	
				}
			});
		});
	</script>

@endsection