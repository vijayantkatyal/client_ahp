@extends('_layouts.admin')
@section('title','Class Resources')
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
					{{ $class->name }} / Resources
				</h2>
			</div>
            <div class="col text-end">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-new-photos">+ Add Photos</button>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-new-videos">+ Add Videos</button>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-new-note">+ Add Note</button>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-new-docs">+ Add Docs / Papers</button>
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
					
					<div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Photos</h3>
                        </div>
                        <div class="col-6 text-end">
                        </div>
					</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($photos as $photo)
                                <div class="col-md-2">
                                    <img src="{{ asset($photo->file_path) }}" class="img-thumbnail img-fluid" alt="...">
                                    <br/>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a target="_blank" href="{{ asset($photo->file_path) }}" class="btn btn-outline-primary"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></a>
                                        <a href="{{ route('get_admin_class_resource_delete', ['id' => $photo->id]) }}" class="btn btn-outline-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="card mb-4" id="general">
					
					<div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Videos</h3>
                        </div>
                        <div class="col-6 text-end">
                        </div>
					</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($videos as $photo)
                                <div class="col-md-4">
                                    {{ explode("/", $photo->file_path)[3] }} &nbsp;
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a target="_blank" href="{{ asset($photo->file_path) }}" class="btn btn-outline-primary"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></a>
                                        <a href="{{ route('get_admin_class_resource_delete', ['id' => $photo->id]) }}" class="btn btn-outline-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="card mb-4" id="general">
					
					<div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Docs</h3>
                        </div>
                        <div class="col-6 text-end">
                        </div>
					</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($docs as $photo)
                                <div class="col-md-4">
                                    {{ explode("/", $photo->file_path)[3] }} &nbsp;
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a target="_blank" href="{{ asset($photo->file_path) }}" class="btn btn-outline-primary"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></a>
                                        <a href="{{ route('get_admin_class_resource_delete', ['id' => $photo->id]) }}" class="btn btn-outline-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="card mb-4" id="general">
					
					<div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Notes</h3>
                        </div>
                        <div class="col-6 text-end">
                        </div>
					</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($notes as $note)
                                <div class="col-md-4">
                                    {{ $note->name }} @if($note->date)({{ $note->date }})@endif
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a target="_blank" href="{{ route('get_admin_class_note', ['id' => $note->id]) }}" class="btn btn-outline-primary"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></a>
                                        <a href="{{ route('get_admin_class_resource_delete', ['id' => $note->id]) }}" class="btn btn-outline-danger"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
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

<div class="modal modal-blur fade" id="modal-new-photos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Photo(s)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('post_add_class_resource_photos') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="class_id" value="{{ $class->id }}" />
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

<div class="modal modal-blur fade" id="modal-new-videos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Video(s)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('post_add_class_resource_videos') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="class_id" value="{{ $class->id }}" />
                {{ csrf_field() }}
                <div class="modal-body">
                    @component('_layouts.components.alert')
                    @endcomponent

                    <input type="file" name="photos[]" class="form-control" multiple required id="">
                    <div class="form-text">can upload multiple videos at once (use ctrl)</div>
                    <div class="form-text">supported formats: mp4, mpeg, avi</div>

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

<div class="modal modal-blur fade" id="modal-new-docs" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Doc(s)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('post_add_class_resource_docs') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="class_id" value="{{ $class->id }}" />
                {{ csrf_field() }}
                <div class="modal-body">
                    @component('_layouts.components.alert')
                    @endcomponent

                    <input type="file" name="photos[]" class="form-control" multiple required id="">
                    <div class="form-text">can upload multiple file at once (use ctrl)</div>
                    <div class="form-text">supported formats: doc, docx, pdf, .xsl, jpeg, png</div>

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

<div class="modal modal-blur fade" id="modal-new-note" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('post_add_class_resource_note') }}" method="POST">
                <input type="hidden" name="class_id" value="{{ $class->id }}" />
                {{ csrf_field() }}
                <div class="modal-body">
                    @component('_layouts.components.alert')
                    @endcomponent

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="name" placeholder="Name" required class="form-control" value="" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" placeholder="Name" class="form-control" value="" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="description" class="form-control" id="" rows="6" placeholder="Note"></textarea>
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