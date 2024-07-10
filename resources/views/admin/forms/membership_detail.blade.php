@extends('_layouts.admin')
@section('title','Membership Form Details')

@section('header')
<style>
    .form-data {
        font-weight: bold;
    }
</style>
@endsection

@section('content')

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Membership Form / #{{ $form->id }}
				</div>
				<h2 class="page-title">
					{{ $form->first_name }} {{ $form->last_name }}
					<small class="text-muted">
					{{ $form->email }}
					</small>
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
						<h3 class="card-title">General</h3>
					</div>
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Name</label>
                            <div class="col form-data">
                                {{ $form->name }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Spouse Name</label>
                            <div class="col form-data">
                                {{ $form->spouse_name }}
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Email Address</label>
                            <div class="col form-data">
                                {{ $form->email }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Telephone Number</label>
                            <div class="col form-data">
                                {{ $form->tel_no }}
                            </div>
                        </div>
                    </div>
				</div>

                <div class="card mb-4" id="general">
					<div class="card-header">
						<h3 class="card-title">Address</h3>
					</div>
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Mailing Address</label>
                            <div class="col form-data">
                                {{ $form->mailing_address }}
                            </div>
                        </div>
                    </div>
				</div>

                <div class="card mb-4" id="general">
					<div class="card-header">
						<h3 class="card-title">Payment Info</h3>
					</div>
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Membership For</label>
                            <div class="col form-data">
                                {{ $form->membership_for }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Fee Paid</label>
                            <div class="col form-data">
                                {{ $form->fee_paid }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Fee Paid Reference ID</label>
                            <div class="col form-data">
                                {{ $form->fee_paid_ref_id }}
                            </div>
                        </div>
                    </div>
				</div>

                <div class="card mb-4" id="general">
					<div class="card-header">
						<h3 class="card-title">Volunteer Info</h3>
					</div>
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Program</label>
                            <div class="col form-data">
                                {{ $form->volunteer_program }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">School</label>
                            <div class="col form-data">
                                {{ $form->volunteer_school }}
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Office</label>
                            <div class="col form-data">
                                {{ $form->volunteer_office }}
                            </div>
                        </div>
                        
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Library</label>
                            <div class="col form-data">
                                {{ $form->volunteer_library }}
                            </div>
                        </div>
                    </div>
				</div>

                <div class="card mb-4" id="general">
					<div class="card-header">
						<h3 class="card-title">Reference Info</h3>
					</div>
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Introduced By</label>
                            <div class="col form-data">
                                {{ $form->introduced_by }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Introduced By (Name)</label>
                            <div class="col form-data">
                                {{ $form->introduced_by_name }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Approved By</label>
                            <div class="col form-data">
                                {{ $form->approved_by }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Approved By (Name)</label>
                            <div class="col form-data">
                                {{ $form->approved_by_name }}
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