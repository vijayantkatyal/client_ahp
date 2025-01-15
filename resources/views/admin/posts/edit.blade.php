@extends('_layouts.admin')
@section('title','Post')

@section('header')
<style>
	.ck.ck-toolbar,
	.ck.ck-list,
	.ck.ck-dropdown__panel,
	.ck.ck-responsive-form {
		background: #363636 !important;
		background-color: #363636 !important;
	}

	.ck.ck-labeled-field-view.ck-disabled.ck-labeled-field-view_empty>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label, .ck.ck-labeled-field-view.ck-labeled-field-view_empty:not(.ck-labeled-field-view_focused):not(.ck-labeled-field-view_placeholder)>.ck.ck-labeled-field-view__input-wrapper>.ck.ck-label,
	.ck.ck-input,
	.ck.ck-find-and-replace-form fieldset .ck-labeled-field-view .ck-input,
	.ck-reset_all input[type=password]:not(.ck-reset_all-excluded *), .ck-reset_all input[type=text]:not(.ck-reset_all-excluded *), .ck-reset_all textarea:not(.ck-reset_all-excluded *) {
		color: #363636 !important;
	}

	.ck.ck-reset_all, .ck.ck-reset_all * {
		color: #fff !important;
	}

	/* .ck.ck-button:not(.ck-disabled):hover, a.ck.ck-button:not(.ck-disabled):hover {
		background-color: ;
	} */

	.ck.ck-button.ck-on, .ck.ck-button:not(.ck-disabled):hover, a.ck.ck-button.ck-on, a.ck.ck-button:not(.ck-disabled):hover,
	.ck.ck-button:not(.ck-disabled):active, a.ck.ck-button:not(.ck-disabled):active,
	.ck.ck-splitbutton.ck-splitbutton_open>.ck-button:not(.ck-on):not(.ck-disabled):not(:hover), .ck.ck-splitbutton:hover>.ck-button:not(.ck-on):not(.ck-disabled):not(:hover) {
		background-color: #7a7777 !important;
	}

	.ck-editor__editable {
		min-height: 100px !important;
	}

    .ck-restricted-editing_mode_standard {
        height: 500px;
    }
</style>
@endsection

@section('content')

    <form id="template_edit" method="post" action="{{ route('post_edit_post') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $page->id }}"/>
        <!-- header -->
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Edit Post / {{ $page->title }}
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="d-flex">
                            <button type="submit" class="btn btn-success">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- content -->
        <div class="page-body">
            <div class="container-xl">

                @component('_layouts.components.alert')
                @endcomponent

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Published</label>
                                    <select name="published" class="form-control">
                                        <option @if($page->published == false) selected @endif value="0">No</option>
                                        <option @if($page->published == true) selected @endif value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Publish Date</label>
                                    <input type="date" class="form-control" name="created_at" placeholder="" value="{{ $page->created_at }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

				<div class="card mt-2">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" required value="{{ $page->name }}" pattern="[A-Za-z0-9]+"/>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title" required value="{{ $page->title }}"/>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Short Summary (optional)</label>
                            <textarea class="form-control" rows="4" name="summary" id="">{{ $page->summary }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Image (optional)</label>
                            <input type="file" class="form-control" name="image" placeholder="" />
                            @if($page->image != null)
                                <br/>
                                <img src="{{ asset($page->image) }}" style="width: 200px;"/>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea id="editor" class="form-control" rows="20" name="content" id="">{{ $page->content }}</textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection

@section('footer')

<script src="{{ asset('assets/ckeditor/build/ckeditor.js') }}"></script>

<script>
	const watchdog = new CKSource.EditorWatchdog();

	window.watchdog = watchdog;

	watchdog.setCreator((element, config) => {
		return CKSource.Editor
			.create(element, config)
			.then(editor => {
				return editor;
			})
	});

	watchdog.setDestructor(editor => {
		return editor.destroy();
	});

	watchdog.on('error', handleError);

	watchdog
		.create(document.querySelector('#editor'), {
			licenseKey: '',
			fontSize: {
				options: [
					8,
					9,
					10,
					11,
					12,
					13,
					14,
					16,
					18,
					'default',
					20,
					22,
					24,
					26,
					28,
					30,
					32,
					34,
					36,
					38,
					40,
				],
				supportAllValues: true
			}
			// toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ]
		})
		.catch(handleError);

	function handleError(error) {
		console.error('Oops, something went wrong!');
		console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
		console.warn('Build id: k1xroqk8si57-w0dl60rey6wv');
		console.error(error);
	}
</script>

<script>
	const watchdog_subject = new CKSource.EditorWatchdog();

	window.watchdog_subject = watchdog_subject;

	watchdog_subject.setCreator((element, config) => {
		return CKSource.Editor
			.create(element, config)
			.then(editor => {
				// editor.ui.view.editable.element.style.cssText = 'height: 50px !important; min-height: 50px !important;';
				// editor.ui.view.editable.element.style.minHeight = '50px !important';
				// editor.ui.view.editable.element.style.maxHeight = '50px !important';
				return editor;
			})
	});

	watchdog_subject.setDestructor(editor => {
		return editor.destroy();
	});

	watchdog_subject.on('error', handleError_subject);

	watchdog_subject
		.create(document.querySelector('#editor_subject'), {
			licenseKey: '',
			// toolbar: [ 'bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote' ]
		})
		.catch(handleError_subject);

	function handleError_subject(error) {
		console.error('Oops, something went wrong!');
		console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
		console.warn('Build id: k1xroqk8si57-w0dl60rey6wv');
		console.error(error);
	}
</script>

<script>
	$("#template_edit").submit(function(e){
		e.preventDefault();

		var _data = watchdog.editor.getData();

		console.log(_data);

		$("#editor").val(_data);

		var form = $(this);
		var actionUrl = form.attr('action');
		
		$.ajax({
			type: "POST",
			url: actionUrl,
			// data: form.serialize(), // serializes the form's elements.
            contentType: false,
            cache: false,
            processData:false,
            data: new FormData(this),
			success: function(data)
			{
				alert(data); // show response from the php script.
				// alertify.success("Saved !!");
			}
		});
	});
</script>

@endsection