@extends('_layouts.admin')
@section('title','Note')
@section('header')

@endsection

@section('content')

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Event / #{{ $note->id }}
				</div>
				<h2 class="page-title">
					{{ $note->name }}
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
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Title</label>
                            <div class="col form-data">
                                {{ $note->name }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Date</label>
                            <div class="col form-data">
                                {{ $note->date }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-form-label mb-2">Description</label>
                            <div class="col-12 form-data">
                                {{ $note->description }}
                            </div>
                        </div>
                    </div>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection

@section('footer')
@endsection