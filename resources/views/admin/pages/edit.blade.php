@extends('_layouts.admin')
@section('title','Page')

@section('header')
@if($page->type != "custom")
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
@endif
@endsection

@section('content')

    <form method="post" @if($page->type != "custom") id="template_edit" @endif action="{{ route('post_edit_page') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $page->id }}"/>
        <!-- header -->
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Edit Page / {{ $page->name }}
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

				@if($page->type != "custom")
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Show in Top Menu</label>
                                    <select name="show_in_top_menu" class="form-control">
                                        <option @if($page->show_in_top_menu == false) selected @endif value="0">No</option>
                                        <option @if($page->show_in_top_menu == true) selected @endif value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Show in Footer Menu</label>
                                    <select name="show_in_footer" class="form-control">
                                        <option @if($page->show_in_footer == false) selected @endif value="0">No</option>
                                        <option @if($page->show_in_footer == true) selected @endif value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				@endif

                <div class="card mt-2 mb-2">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" pattern="[A-Za-z0-9]+" required value="{{ $page->name }}"/>
                        </div>
                    </div>
                </div>

				@if($page->type == "custom")

					@if($page->page_schema != null)

						<?php
							$page_schema = json_decode($page->page_schema, true);
						?>

						@foreach($page_schema['blocks'] as $block)

							<div class="card mb-2">
								<div class="card-header text-capitalize">
									<label class="form-label p-0 m-0">{{ $block['name'] }}</label>
								</div>

								@if($block['type'] == "single")
									
									<div class="card-body">
										@foreach($block['attributes'] as $key => $attribute)
											<div class="mb-3">
												<label class="form-label p-0 m-0 text-capitalize">{{ str_replace("_", " ", $key) }}</label>
												@if(is_array($attribute))
													<?php
														$counts = 0;
													?>
													@foreach($attribute as $subKey => $attributeItem)
														
														@if(is_array($attributeItem))
														
															@if($attribute['type'] == "collection")
																
																@if($subKey == "attributes")
																	<div class="border p-3 mt-2">
																		@for($i = 0; $i < count($attribute["values"]); $i++ )
																			<div class="border p-3 mt-2">
																			@foreach($attributeItem as $subSubKey => $subAttributeItem)
																				<label class="form-label p-0 mt-2 text-capitalize">{{ str_replace("_", " ", $subSubKey) }}</label>
																				@if($subAttributeItem["type"] == "rich_text")
																					<textarea class="form-control" name="{{ 'page_schema['.$block['name'].']['.$key.']'.'['.$i.']['.$subSubKey.']' }}" rows="4" id="">{{ $attribute['values'][$i][$subSubKey] }}</textarea>
																				@endif
																				@if($subAttributeItem["type"] == "text")
																					<input type="text" class="form-control" name="{{ 'page_schema['.$block['name'].']['.$key.']'.'['.$i.']['.$subSubKey.']' }}" placeholder="" value="{{ $attribute['values'][$i][$subSubKey] }}"/>
																				@endif
																				@if($subAttributeItem["type"] == "file")
																					@if(isset($attribute['values'][$i][$subSubKey]))
																						<img src="{{ asset($attribute['values'][$i][$subSubKey]) }}" style="width: 300px;"/>
																						<br/>
																						<input type="hidden" name="{{ 'page_schema['.$block['name'].']['.$key.']'.'['.$i.']['.$subSubKey.']' }}" value="{{ $attribute['values'][$i][$subSubKey] }}"/>
																					@else
																						<input type="file" class="form-control new_file_upload_in_collection" data-bid="{{ $block['name'] }}" data-key="{{ $i }}" data-aid="{{ $key }}" data-fid="{{ $subSubKey }}" name="{{ 'page_schema['.$block['name'].']['.$key.']'.'['.$i.']['.$subSubKey.']' }}"/>
																					@endif
																				@endif
																			@endforeach
																			<a href="{{ route('remove_item_from_collection', ['pid' => $page->id, 'bid' => $block['name'], 'aid' => $key, 'key' => $i]) }}" class="mt-2 btn btn-outline-danger delete_confirm_link">Remove</a>
																			</div>
																		@endfor
																		<button
																			type="button"
																			class="mt-2 btn w-100 btn-outline-primary add_item_in_collection"
																			data-collection="{{ json_encode($attributeItem) }}"
																			data-parent="{{ $key }}"
																			data-key="{{ count($attribute['values']) }}"
																			data-block="{{ $block['name'] }}"
																		>
																			Add More
																		</button>
																	</div>
																@endif
															@endif

															@if($attribute['type'] == "single")
																ss
															@endif

															<?php $counts++ ?>

														@else

															@if($subKey == "type")
																@if($attributeItem == "rich_text")
																	<textarea name="{{ 'page_schema['.$block['name'].']['.$key.']' }}" class="form-control" rows="4" id="">{{ $attribute['value'] }}</textarea>
																@endif
																@if($attributeItem == "text")
																	<input type="text" class="form-control" name="{{ 'page_schema['.$block['name'].']['.$key.']' }}" placeholder="" value="{{ $attribute['value'] }}"/>
																@endif
																@if($attributeItem == "file")
																	@if($attribute['value'] != null)
																		<img src="{{ asset($attribute['value']) }}" style="width: 400px;" />
																		<br/><br/>
																		<a href="{{ route('remove_item', ['pid' => $page->id, 'bid' => $block['name'], 'aid' => $key]) }}" class="mt-2 btn btn-outline-danger delete_confirm_link">Remove</a>

																		<input type="hidden" name="{{ 'page_schema['.$block['name'].']['.$key.']' }}" value="{{ $attribute['value'] }}" />
																	@else
																		<input type="file" data-bid="{{ $block['name'] }}" data-key="{{ $key }}" name="{{ 'page_schema['.$block['name'].']['.$key.']' }}" class="form-control new_file_upload" />
																	@endif
																@endif
															@endif

														@endif

													@endforeach
												@else
													dd: {{ $value }}
												@endif
											</div>
										@endforeach
									</div>

								@endif

								@if($block['type'] == "collection")
								<div class="card-body">
									<div class="border p-3 mt-2">
									@for($i = 0; $i < count($block["values"]); $i++ )
										<div class="border p-3 mt-2">
										@foreach($block['attributes'] as $key => $attribute)
											<div class="mb-3">
												<label class="form-label p-0 m-0 text-capitalize">{{ str_replace("_", " ", $key) }}</label>

												@if($attribute["type"] == "rich_text")
													<textarea class="form-control" name="{{ 'page_schema['.$block['name'].']['.$i.']['.$key.']' }}" rows="4" id="">{{ $block['values'][$i][$key] }}</textarea>
												@endif
												@if($attribute["type"] == "text")
													<input type="text" class="form-control" name="{{ 'page_schema['.$block['name'].']['.$i.']['.$key.']' }}" placeholder="" value="{{ $block['values'][$i][$key] }}"/>
												@endif
												@if($attribute["type"] == "file")
													@if(isset($block['values'][$i][$key]))
														<img src="{{ asset($block['values'][$i][$key]) }}" style="width: 300px;"/>
														<br/>
														<input type="hidden" name="{{ 'page_schema['.$block['name'].']['.$i.']['.$key.']' }}" value="{{ $block['values'][$i][$key] }}"/>
													@else
														<input type="file" class="form-control new_file_upload_in_collection" data-bid="{{ $block['name'] }}" data-key="{{ $i }}" data-aid="{{ $key }}" data-fid="" name="{{ 'page_schema['.$block['name'].']['.$i.']['.$key.']' }}"/>
													@endif
												@endif
											</div>
										@endforeach
										<a href="{{ route('remove_item_from_collection', ['pid' => $page->id, 'bid' => $block['name'], 'aid' => $key, 'key' => $i]) }}" class="mt-2 btn btn-outline-danger delete_confirm_link">Remove</a>
										</div>
									@endfor
									<button
										type="button"
										class="mt-2 btn w-100 btn-outline-primary add_item_in_collection"
										data-collection="{{ json_encode($block['attributes']) }}"
										data-key="{{ count($block['values']) }}"
										data-block="{{ $block['name'] }}"
									>
										Add More
									</button>
									</div>
								</div>
								@endif

							</div>
						@endforeach

					@endif

				@else

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

				@endif

            </div>
        </div>
    </form>

@endsection

@section('footer')

@if($page->type != "custom")
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

@else
<script>
	$(".add_item_in_collection").click(function(){
		var _this = $(this);
		
		var _data_block = _this.data("block");
		var _data_parent = _this.data("parent");
		var _data_collection = _this.data("collection");

		// get count
		var _parent = $(this).parents("div.border");
		var _current_count = _parent.children("div.border").length;

		var _data_key = _current_count;

		var _fileds = '';
		for (var key in _data_collection) {
			const element = _data_collection[key];
			console.log(element);
			console.log(key);

			if(_data_parent != undefined)
			{
				if(element.type == "text")
				{
					var _el = `
						<label class="form-label p-0 mt-2 text-capitalize">`+ key +`</label>
						<input type="text" class="form-control" name="page_schema[`+ _data_block +`][`+_data_parent+`][`+ _data_key +`][`+key+`]" placeholder="" value="">
					`;

					_fileds += _el;
				}
				if(element.type == "rich_text")
				{
					var _el = `
						<label class="form-label p-0 mt-2 text-capitalize">`+ key +`</label>
						<textarea class="form-control" name="page_schema[`+ _data_block +`][`+_data_parent+`][`+ _data_key +`][`+key+`]" placeholder="" value=""></textarea>
					`;

					_fileds += _el;
				}
				if(element.type == "file")
				{
					var _el = `
						<label class="form-label p-0 mt-2 text-capitalize">`+ key +`</label>
						<input type="file" class="form-control new_file_upload_in_collection" data-bid="`+_data_block+`" data-key="`+_data_key+`" data-aid="`+_data_parent+`" data-fid="`+key+`" name="page_schema[`+ _data_block +`][`+_data_parent+`][`+ _data_key +`][`+key+`]" placeholder="" value=""/>
					`;

					_fileds += _el;
				}
			}
			else
			{
				if(element.type == "text")
				{
					var _el = `
						<label class="form-label p-0 mt-2 text-capitalize">`+ key +`</label>
						<input type="text" class="form-control" name="page_schema[`+ _data_block +`][`+ _data_key +`][`+key+`]" placeholder="" value="">
					`;

					_fileds += _el;
				}
				if(element.type == "rich_text")
				{
					var _el = `
						<label class="form-label p-0 mt-2 text-capitalize">`+ key +`</label>
						<textarea class="form-control" name="page_schema[`+ _data_block +`][`+ _data_key +`][`+key+`]" placeholder="" value=""></textarea>
					`;

					_fileds += _el;
				}
				if(element.type == "file")
				{
					var _el = `
						<label class="form-label p-0 mt-2 text-capitalize">`+ key +`</label>
						<input type="file" class="form-control new_file_upload_in_collection" data-bid="`+_data_block+`" data-key="`+_data_key+`" data-aid="`+ key +`" data-fid="" name="page_schema[`+ _data_block +`][`+ _data_key +`][`+key+`]" placeholder="" value=""/>
					`;

					_fileds += _el;
				}	
			}
		}

		var _block =
		`<div class="border p-3 mt-2">`+ _fileds +`</div>`;

		$(_block).insertBefore(this);
	});

	$("body").on("change", ".new_file_upload_in_collection", function(e){
		let file = e.target.files[0];
		// var _input_name = $(this).attr("name");
		var _bid = $(this).data("bid");
		var _aid = $(this).data("aid");
		var _fid = $(this).data("fid");
		var _key = $(this).data("key");
		
		var formData = new FormData();
		
		formData.append("_token", "{{ csrf_token() }}");
		formData.append("_page_id", "{{ $page->id }}");
		formData.append("_bid", _bid);
		formData.append("_aid", _aid);
		formData.append("_key", _key);
		formData.append("_fid", _fid);
		// formData.append("_field_name", _input_name);
		formData.append("image_file", file);

		$.ajax({
			url : '{{ route("post_add_image_to_collection") }}',
			type : 'POST',
			data : formData,
			processData: false,  // tell jQuery not to process the data
			contentType: false,  // tell jQuery not to set contentType
			success : function(data) {
				if(data = "done")
				{
					alert(data);
					location.reload();
				}
				else
				{
					console.log(data);
					alert(data);
				}
			}
		});
	});

	$("body").on("change", ".new_file_upload", function(e){
		let file = e.target.files[0];
		// var _input_name = $(this).attr("name");
		var _bid = $(this).data("bid");
		var _key = $(this).data("key");
		
		var formData = new FormData();
		
		formData.append("_token", "{{ csrf_token() }}");
		formData.append("_page_id", "{{ $page->id }}");
		formData.append("_bid", _bid);
		formData.append("_key", _key);
		// formData.append("_field_name", _input_name);
		formData.append("image_file", file);

		$.ajax({
			url : '{{ route("post_add_image") }}',
			type : 'POST',
			data : formData,
			processData: false,  // tell jQuery not to process the data
			contentType: false,  // tell jQuery not to set contentType
			success : function(data) {
				if(data = "done")
				{
					alert(data);
					location.reload();
				}
				else
				{
					console.log(data);
					alert(data);
				}
			}
		});
	});
</script>
@endif

@endsection