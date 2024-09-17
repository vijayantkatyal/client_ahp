@extends('_layouts.admin')
@section('title','Class Assignments')
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
					{{ $class->name }} / Assignments
				</h2>
			</div>
            <div class="col text-end">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-new-assignment-file">+ Add Assignment (File)</button>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-new-assignment-note">+ Add Assignment (Note)</button>
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
                                    <th>Type</th>
                                    <th>Assignment Type</th>
                                    <th>File / Note</th>
                                    <th>Max Marks</th>
                                    <th>Assigned</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignments as $assignment)
                                <tr>
                                    <td>{{ $assignment->name }}</td>
                                    <td class="text-capitalize">{{ str_replace("_", " ", $assignment->type) }}</td>
                                    <td class="text-capitalize">{{ $assignment->file_type }}</td>
                                    <td>
                                        @if($assignment->file_type == "file")
                                            @foreach(json_decode($assignment->file) as $file)
                                                <a target="_blank" title="click to view" class="btn btn-outline-primary" href="{{ asset($file) }}">{{ $file }}</a>
                                            @endforeach
                                        @else
                                            <a target="_blank" title="click to view" class="btn btn-outline-primary" href="{{ route('get_admin_class_assignment_note', ['id' => $assignment->id]) }}">View Note</a>
                                        @endif
                                    </td>
                                    <td>{{ $assignment->max_marks }}</td>
                                    <td>
                                        @if($assignment->published)
                                            <i class="text-success"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg></i>
                                        @else
                                            <i class="text-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if($assignment->published == false)
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                                            </button>
                                            <ul class="dropdown-menu">        
                                                <button class="dropdown-item" onclick="event.preventDefault();document.getElementById('assign-assignment-{{ $assignment->id }}').submit();">
                                                    Assign
                                                </button>
                                                <form id="assign-assignment-{{ $assignment->id }}" action="{{ route('post_assign_class_assignment') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" value="{{ $assignment->id }}" name="assignment_id"/>
                                                </form>
                                                <li><a class="dropdown-item text-danger delete_a_thing" href="{{ route('get_admin_class_assignment_delete', ['id' => $assignment->id]) }}">Delete</a></li>
                                            </ul>
                                        </div>
                                        @else
                                        <a href="{{ route('get_admin_assignments_submissions', ['id' => $assignment->id]) }}" class="btn btn-outline-success">View Submissions</a>
                                        @endif
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

<div class="modal modal-blur fade" id="modal-new-assignment-file" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('post_add_class_assignment_file') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="class_id" value="{{ $class->id }}" />
                {{ csrf_field() }}
                <div class="modal-body">
                    @component('_layouts.components.alert')
                    @endcomponent

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-control" id="" required>
                            <option value="home_work">Home Work</option>
                            <option value="assignment">Assignment</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="name" placeholder="Name" required class="form-control" value="" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File</label>
                        <input type="file" name="file[]" class="form-control" multiple required id="">
                        <div class="form-text">can upload multiple files. supported formats: doc, pdf, docx, jpeg, png</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Max Marks (optional)</label>
                        <input type="number" name="max_marks" placeholder="100" class="form-control" value="" min="0"/>
                    </div>

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

<div class="modal modal-blur fade" id="modal-new-assignment-note" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('post_add_class_assignment_note') }}" method="POST">
                <input type="hidden" name="class_id" value="{{ $class->id }}" />
                {{ csrf_field() }}
                <div class="modal-body">
                    @component('_layouts.components.alert')
                    @endcomponent

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-control" id="" required>
                            <option value="home_work">Home Work</option>
                            <option value="assignment">Assignment</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="name" placeholder="Name" required class="form-control" value="" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Max Marks (optional)</label>
                        <input type="number" name="max_marks" placeholder="100" class="form-control" value="" min="0"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="note" class="form-control" id="" rows="6" required placeholder="Note"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-success ms-auto">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section("footer")

<script>
    $("select[name=course_id]").val("{{ $class->course_id }}");
</script>

@endsection