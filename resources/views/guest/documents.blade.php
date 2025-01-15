@extends('_layouts.guest')
@section('title', 'Documents')

@section('header')
@endsection

@section('content')

<div class="page container">
    <h2 class="element-heading col-lg-12">Documents</h2>
    <br/>
    <div class="row">
        <div class="col-12 col-md-4 mb-1">
            <div class="card card-body">
                <h4 class="card-title">School Registration</h4>
                <a href="{{ asset('/files/registration.pdf') }}" class="btn btn-primary">Download</a>&nbsp;&nbsp;&nbsp;
                <a href="{{ route('get_form_registration') }}" class="btn btn-primary">Apply Online</a>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-1">
            <div class="card card-body">
                <h4 class="card-title">Membership Form</h4>
                <a href="{{ asset('/files/membership.pdf') }}" class="btn btn-primary">Download</a>&nbsp;&nbsp;&nbsp;
                <a href="{{ route('get_form_membership') }}" class="btn btn-primary">Apply Online</a>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-1">
            <div class="card card-body">
                <h4 class="card-title">Field Trip Form</h4>
                <a href="{{ asset('/files/field.pdf') }}" class="btn btn-primary">Download</a>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-1">
            <div class="card card-body">
                <h4 class="card-title">School Calendar</h4>
                <a href="{{ route('get_calendar_school') }}" class="btn btn-primary">View</a>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-1">
            <div class="card card-body">
                <h4 class="card-title">Director Duty Calendar</h4>
                <a href="{{ route('get_calendar_director_duty') }}" class="btn btn-primary">View</a>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-1">
            <div class="card card-body">
                <h4 class="card-title">AHP News Letter</h4>
                <a href="{{ asset('/files/AHPNewsletter.pdf') }}" class="btn btn-primary">Download</a>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-1">
            <div class="card card-body">
                <h4 class="card-title">AHP News Letter (Past)</h4>
                <a href="{{ asset('/files/AHPNewsletter_past.pdf') }}" class="btn btn-primary">Download</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection