@extends('_layouts.admin')
@section('title','Class Edit')
@section('header')

@endsection

@section('content')

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Class / #{{ $class->id }}
				</div>
				<h2 class="page-title">
					{{ $class->name }}
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
					
					<div class="card-header">
						<h3 class="card-title">Edit Info</h3>
					</div>
					<form action="{{ route('post_admin_class_edit', $class->id) }}" method="post">
						{{ csrf_field() }}
                        <input type="hidden" name="class_id" value="{{ $class->id }}"/>
						<div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Class name</label>
                                <input
                                    type="text" name="name" required placeholder="Name" value="{{ $class->name }}"
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
                                    type="date" name="start_date" placeholder="Start Date" value="{{ $class->start_date }}"
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
                                    type="date" name="end_date" placeholder="" value="{{ $class->end_date }}"
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
                                <label class="form-label">Assigned Member (optional)</label>
                                <select name="assigned_member_id" class="form-select" id=""></select>
                            </div>
						</div>
						<div class="card-footer">
							<div class="d-flex">
								<a href="{{ route('get_admin_users_index') }}" class="btn btn-link">Cancel</a>
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

@section("footer")

<script>
    $("select[name=course_id]").val("{{ $class->course_id }}");
</script>

@endsection