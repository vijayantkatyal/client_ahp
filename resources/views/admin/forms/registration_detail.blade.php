@extends('_layouts.admin')
@section('title','Registration Form Details')

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
					Registration Form / #{{ $form->id }}
				</div>
				<h2 class="page-title">
					{{ $form->first_name }} {{ $form->last_name }}
					<small class="text-muted ps-1">
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

                <div class="card mb-4" id="security">
					<div class="card-header">
						<h3 class="card-title">Fee Verification</h3>
					</div>
					<form action="{{ route('post_admin_forms_registration_detail') }}" method="post">
						{{ csrf_field() }}
                        <input type="hidden" name="form_id" value="{{ $form->id }}"/>
						<div class="card-body">

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Receipt Fee</label>
								<div class="col">
									<input type="text" name="receipt_fee" required class="form-control" value="{{ $form->receipt_fee }}" placeholder="Receipt Fee" />
								</div>
							</div>

							<div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Receipt Membership</label>
								<div class="col">
									<input type="text" name="receipt_membership" required class="form-control" value="{{ $form->receipt_membership }}" placeholder="Receipt Membership" />
								</div>
							</div>

                            <div class="form-group mb-3 row">
								<label class="form-label col-12 col-sm-3 col-form-label">Supplies Provided</label>
								<div class="col">
                                    <select name="supplies_provided" class="form-control" id="">
                                        <option @if($form->supplies_provided == false || $form->supplies_provided == null) selected @endif value="No">No</option>
                                        <option @if($form->supplies_provided) selected @endif value="Yes">Yes</option>
                                    </select>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="d-flex">
								<a href="{{ route('get_admin_users_index') }}" class="btn btn-link">Cancel</a>
								<button type="submit" class="btn btn-success ms-auto">Save Changes</button>
							</div>
						</div>
					</form>
				</div>

				<div class="card mb-4" id="general">
					<div class="card-header">
						<h3 class="card-title">General</h3>
					</div>
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">First Name</label>
                            <div class="col form-data">
                                {{ $form->first_name }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Last Name</label>
                            <div class="col form-data">
                                {{ $form->last_name }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col form-data">
                                {{ $form->date_of_birth }}
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
                                {{ $form->address }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">City</label>
                            <div class="col form-data">
                                {{ $form->city }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Postal Code</label>
                            <div class="col form-data">
                                {{ $form->postal_code }}
                            </div>
                        </div>
                    </div>
				</div>

                <div class="card mb-4" id="general">
					<div class="card-header">
						<h3 class="card-title">Parent's Info</h3>
					</div>
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Father Name</label>
                            <div class="col form-data">
                                {{ $form->father_name }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Mother Name</label>
                            <div class="col form-data">
                                {{ $form->mother_name }}
                            </div>
                        </div>
                    </div>
				</div>

                <div class="card mb-4" id="general">
					<div class="card-header">
						<h3 class="card-title">Language Info</h3>
					</div>
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Family Language</label>
                            <div class="col form-data">
                                {{ $form->family_language }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Student Knows Hindi ?</label>
                            <div class="col form-data">
                                {{ $form->know_hindi }}
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Why Need To Learn</label>
                            <div class="col form-data">
                                {{ $form->why_need_to_learn }}
                            </div>
                        </div>
                        
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Hindi (Speak)</label>
                            <div class="col form-data">
                                {{ $form->hindi_speak }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Hindi (Read)</label>
                            <div class="col form-data">
                                {{ $form->hindi_read }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Hindi (Write)</label>
                            <div class="col form-data">
                                {{ $form->hindi_write }}
                            </div>
                        </div>
                    </div>
				</div>

                <div class="card mb-4" id="general">
					<div class="card-header">
						<h3 class="card-title">Past History</h3>
					</div>
                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Are you Student Before ?</label>
                            <div class="col form-data">
                                {{ $form->student_before }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Which Year</label>
                            <div class="col form-data">
                                {{ $form->student_before_year }}
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label for="" class="form-label col-12 col-sm-3 col-form-label">Which Level</label>
                            <div class="col form-data">
                                {{ $form->student_before_level }}
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

			</div>
		</div>
	</div>
</div>

@endsection

@section('footer')
@endsection