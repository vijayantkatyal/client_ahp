@extends('_layouts.admin')
@section('title','Edit Director Calendar Event')
@section('header')

@endsection

@section('content')

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Event / #{{ $event->id }}
				</div>
				<h2 class="page-title">
					{{ $event->date }}
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
						<h3 class="card-title">Event Details</h3>
					</div>
					<form action="{{ route('post_admin_director_calendar_event_edit') }}" method="post">
						{{ csrf_field() }}
                        <input type="hidden" name="event_id" value="{{ $event->id }}" />
						<div class="card-body">
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">Date</label>
								<div class="col">
									<input
										type="date" name="date" required
										@if($errors->has('date'))
											class="form-control is-invalid"
										@else
											class="form-control"
										@endif
										value="{{ old('date', $event->date) }}"
									/>
									@if($errors->has('date'))
										<div class="invalid-feedback">{{ $errors->first('date') }}</div>
									@endif
								</div>
							</div>
							<div class="form-group mb-3 row">
								<label for="" class="form-label col-12 col-sm-3 col-form-label">School Activity</label>
								<div class="col">
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
							</div>

                            <div class="form-group mb-3 row">
                                <label class="form-label col-12 col-sm-3 col-form-label"># of Classes</label>
                                <div class="col">
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
                            </div>

                            <div class="form-group mb-3 row">
                                <label class="form-label col-12 col-sm-3 col-form-label">Director on Duty</label>
                                <div class="col">
                                    <select class="form-control" name="director_on_duty">
                                        <option value=""></option>
                                        <option value="All">All</option>
                                        @foreach($directors as $director)
                                            <option value="{{ $director->first_name }} {{ $director->last_name }}">{{ $director->first_name }} {{ $director->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label class="form-label col-12 col-sm-3 col-form-label">Program / activity, if any</label>
                                <div class="col">
                                    <input type="text" name="activity" placeholder="Program/activity, if any" class="form-control" value="{{ $event->activity }}" />
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

<script>
    $("select[name=school_activity]").val("{{ $event->school_activity }}");
    $("select[name=no_of_classes]").val("{{ $event->no_of_classes }}");
    $("select[name=director_on_duty]").val("{{ $event->director_on_duty }}");
</script>

@endsection