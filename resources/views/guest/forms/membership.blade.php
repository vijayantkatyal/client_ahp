@extends('_layouts.guest')
@section('title', 'Home')

@section('header')
@endsection

@section('content')

<div class="page container">
    <h2 class="element-heading col-lg-12">General Membership Form</h2>
    
    @if(session('status.success'))
        <div class="alert alert-important alert-success">
            {{ session('status.success') }}
        </div>
    @endif

    @if(session('status.error'))
        <div class="alert alert-important alert-danger">
            {{ session('status.error') }}
        </div>
    @endif

    <br/>
    <div class="row">
        <div class="col-12">
            <form action="{{ route('post_form_membership') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>First Name<span class="required">*</span></label>
                            <input type="text" name="first_name" class="form-control input-field" required="">
                        </div>
                        <div class="col-md-4">
                            <label>Last Name<span class="required">*</span></label>
                            <input type="text" name="last_name" class="form-control input-field" required="">
                        </div>
                        <div class="col-md-4">
                            <label>Spouse Name</label>
                            <input type="text" name="spouse_name" class="form-control input-field">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email Address <span class="required">*</span></label>
                            <input type="email" name="email" class="form-control input-field" required="">
                        </div>
                        <div class="col-md-6">
                            <label>Telephone Number</label>
                            <input type="text" name="tel_no" class="form-control input-field"/>
                        </div>
                    </div>
                </div>
                
                <br/>
                <b>Address</b>
                
                <div class="form-group">
                    <div class="col-12">
                        <label>Mailing Address</label>
                        <textarea name="address" class="form-control" id=""></textarea>
                    </div>
                </div>

                <br/>
                <b>Payment Info</b>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Membership For</label>
                            <select name="membership_for" class="form-control" id="">
                                <option value="Annual">Annual</option>
                                <option value="Life">Life</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Fee Paid</label>
                            <input type="text" name="fee_paid" class="form-control input-field"/>
                        </div>
                        <div class="col-md-4">
                            <label>Fee Paid Reference ID</label>
                            <input type="text" name="fee_paid_ref_id" class="form-control input-field"/>
                        </div>
                    </div>
                </div>

                <br/>
                <b>Volunteer Info</b>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Program</label>
                            <input type="text" name="volunteer_program" class="form-control input-field"/>
                        </div>
                        <div class="col-md-12">
                            <label>School</label>
                            <input type="text" name="volunteer_school" class="form-control input-field"/>
                        </div>
                        <div class="col-md-12">
                            <label>Office</label>
                            <input type="text" name="volunteer_office" class="form-control input-field"/>
                        </div>
                        <div class="col-md-12">
                            <label>Library</label>
                            <input type="text" name="volunteer_library" class="form-control input-field"/>
                        </div>
                    </div>
                </div>

                <br/>
                <b>Reference Info</b>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Introduced By</label>
                            <input type="text" name="introduced_by" class="form-control input-field"/>
                        </div>
                        <div class="col-md-12">
                            <label>Introduced By (Name)</label>
                            <input type="text" name="introduced_by_name" class="form-control input-field"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Approved By</label>
                            <input type="text" name="approved_by" class="form-control input-field"/>
                        </div>
                        <div class="col-md-12">
                            <label>Approved By (Name)</label>
                            <input type="text" name="approved_by_name" class="form-control input-field"/>
                        </div>
                    </div>
                </div>
                
                <br/>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection