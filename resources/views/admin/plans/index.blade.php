@extends('_layouts.admin')
@section('title','Plans')
@section('content')

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title">
					Plans
				</h2>
				<div class="text-muted mt-1">Total {{ sizeof($plans) }}</div>
			</div>
			<!-- Page title actions -->
			<div class="col-auto ms-auto d-print-none">
				<div class="btn-list">
					<a href="{{ route('get_admin_plans_add') }}" class="btn btn-primary">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<line x1="12" y1="5" x2="12" y2="19"></line>
							<line x1="5" y1="12" x2="19" y2="12"></line>
						</svg>
						New Plan
					</a>
					<a href="{{ route('get_admin_plans_schema') }}" class="btn btn-outline-info">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tool" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5"></path>
						</svg>
						Plan Schema
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
		<div class="row">

			@foreach($plans as $plan)
			<div class="col-sm-6 col-lg-3">
				<div class="card card-md">
					<div class="card-body text-center">
						<div class="text-uppercase text-muted font-weight-medium">
							{{ $plan->name }}
						</div>
						<div class="display-5 my-3">${{ $plan->price }}</div>
						<div class="my-3">
							@if($plan->enabled)
							<span class="badge bg-success">Enabled</span>
							@else
							<span class="badge bg-red">Disabled</span>
							@endif
						</div>
						<ul class="list-unstyled lh-lg">
							<li><strong>{{ $plan->valid_time }}</strong> days</li>
						</ul>
						<div class="text-center mt-4">
							<div class="btn-group w-100" role="group" aria-label="Basic example">
								<a href="{{ route('get_admin_plans_edit', $plan->id) }}" class="btn w-100">Edit</a>

								<button class="btn btn-icon" data-bs-boundary="viewport" data-bs-toggle="dropdown">
									<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots-vertical" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<circle cx="12" cy="12" r="1"></circle>
										<circle cx="12" cy="19" r="1"></circle>
										<circle cx="12" cy="5" r="1"></circle>
									</svg>
								</button>
								<div class="dropdown-menu dropdown-menu-end">
									<button type="button" class="dropdown-item" onclick="event.preventDefault();document.getElementById('change-plan-status-{{ $plan->id }}').submit();">
										@if($plan->enabled)
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
									<form id="change-plan-status-{{ $plan->id }}" action="{{ route('post_admin_plans_edit_status', $plan->id) }}" method="POST" style="display: none;">
										{{ csrf_field() }}
										@if($plan->enabled)
											<input type="hidden" name="enabled" value="0">
										@else
											<input type="hidden" name="enabled" value="1">
										@endif
									</form>
									<button class="dropdown-item text-red delete_a_thing" onclick="event.preventDefault();document.getElementById('delete-plan-{{ $plan->id }}').submit();">
										<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
											<line x1="4" y1="7" x2="20" y2="7"></line>
											<line x1="10" y1="11" x2="10" y2="17"></line>
											<line x1="14" y1="11" x2="14" y2="17"></line>
											<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
											<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
										</svg>&nbsp;Delete
									</button>
									<form id="delete-plan-{{ $plan->id }}" action="{{ route('post_admin_plans_delete', $plan->id) }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach

		</div>
	</div>
</div>

@endsection