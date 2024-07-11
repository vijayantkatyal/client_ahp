@extends('_layouts.admin')
@section('title','Edit School Event')
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
					{{ $event->name }}
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
					<form action="{{ route('post_admin_school_event_edit') }}" method="post">
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
                                <label class="form-label col-12 col-sm-3 col-form-label">Name</label>
                                <div class="col">
                                    <input type="text" name="name" required placeholder="Name" class="form-control" value="{{ $event->name }}" />
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label class="form-label col-12 col-sm-3 col-form-label">Description</label>
                                <div class="col">
                                    <textarea name="description" class="form-control" id="" rows="3">{{ $event->description }}</textarea>
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

                <div class="card mb-4" id="general">
					
					<div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Event Photos</h3>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-new-user">+ Add</button>
                        </div>
					</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($photos as $photo)
                                <div class="col-md-2">
                                    <img src="{{ asset($photo->photo) }}" class="img-thumbnail img-fluid" alt="...">
                                    <br/>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a target="_blank" href="{{ asset($photo->photo) }}" class="btn btn-outline-primary"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></a>
                                        <a href="{{ route('get_admin_school_event_photo_delete', ['id' => $photo->id]) }}" class="btn btn-outline-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
					<h5 class="modal-title">Upload Event Photo(s)</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('post_admin_school_event_photos') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="event_id" value="{{ $event->id }}" />
					{{ csrf_field() }}
					<div class="modal-body">
						@component('_layouts.components.alert')
						@endcomponent

						<input type="file" name="photos[]" class="form-control" multiple required id="">
                        <div class="form-text">can upload multiple photos at once (use ctrl)</div>
                        <div class="form-text">supported formats: jpg, jpeg, png</div>

					</div>
					<div class="modal-footer">
						<a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
							Cancel
						</a>
						<button type="submit" class="btn btn-success ms-auto">
							Upload
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>


@endsection

@section('footer')

<script>
    $("select[name=school_activity]").val("{{ $event->school_activity }}");
    $("select[name=no_of_classes]").val("{{ $event->no_of_classes }}");
</script>

@endsection