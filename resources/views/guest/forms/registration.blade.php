@extends('_layouts.guest')
@section('title', 'Home')

@section('header')
@endsection

@section('content')

<div class="page container">
    <h2 class="element-heading col-lg-12">Registration Form</h2>
    
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
            <form action="{{ route('post_form_registration') }}" method="post">
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
                            <label>Date of Birth<span class="required">*</span></label>
                            <input type="date" name="date_of_birth" class="form-control input-field" required="">
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
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>City</label>
                            <input type="text" name="city" class="form-control input-field"/>
                        </div>
                        <div class="col-md-6">
                            <label>Postal Code</label>
                            <input type="text" name="postal_code" class="form-control input-field"/>
                        </div>
                    </div>
                </div>

                <br/>
                <b>Parent's Info</b>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Father Name</label>
                            <input type="text" name="father_name" class="form-control input-field"/>
                        </div>
                        <div class="col-md-6">
                            <label>Mother Name</label>
                            <input type="text" name="mother_name" class="form-control input-field"/>
                        </div>
                    </div>
                </div>

                <br/>
                <b>Language Info</b>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Family Language</label>
                            <input type="text" name="family_language" class="form-control input-field"/>
                        </div>
                        <div class="col-md-6">
                            <label>Student Knows Hindi ?</label>
                            <input type="text" name="know_hindi" class="form-control input-field"/>
                        </div>
                        <div class="col-12">
                            <label>Why Need To Learn</label>
                            <textarea name="why_need_to_learn" class="form-control" id=""></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Hindi (Speak)</label>
                            <select name="hindi_speak" class="form-control" id="">
                                <option value="good">Good</option>
                                <option value="fair">Fair</option>
                                <option value="not_at_all">Not At All</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Hindi (Read)</label>
                            <select name="hindi_read" class="form-control" id="">
                                <option value="good">Good</option>
                                <option value="fair">Fair</option>
                                <option value="not_at_all">Not At All</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Hindi (Write)</label>
                            <select name="hindi_write" class="form-control" id="">
                                <option value="good">Good</option>
                                <option value="fair">Fair</option>
                                <option value="not_at_all">Not At All</option>
                            </select>
                        </div>
                    </div>
                </div>

                <br/>
                <b>Past History</b>

                <div class="row">
                    <div class="col-md-4">
                        <label>Are you Student Before ?</label>
                        <select name="student_before" class="form-control" id="">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Which Year</label>
                        <input type="text" name="student_before_year" class="form-control" id=""/>
                    </div>
                    <div class="col-md-4">
                        <label>Which Level</label>
                        <input type="text" name="student_before_level" class="form-control" id=""/>
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