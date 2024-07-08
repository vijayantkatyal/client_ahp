@extends('_layouts.guest')
@section('title', 'Forms')

@section('header')
@endsection

@section('content')

<div class="page container">
    <h2 class="element-heading col-lg-12">Forms</h2>
    <br/>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card card-body">
                <h4 class="card-title">Registration Form</h4>
                <p class="card-text">Curabitur blandit tempus porttitor. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                <a href="{{ asset('/files/registration.pdf') }}" download="" class="btn btn-primary">Download</a>&nbsp;&nbsp;&nbsp;
                <a href="{{ route('get_form_registration') }}" class="btn btn-primary">Apply Online</a>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-body">
                <h4 class="card-title">Membership Form</h4>
                <p class="card-text">Curabitur blandit tempus porttitor. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                <a href="{{ asset('/files/membership.pdf') }}" download="" class="btn btn-primary">Download</a>&nbsp;&nbsp;&nbsp;
                <a href="{{ route('get_form_membership') }}" class="btn btn-primary">Apply Online</a>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-body">
                <h4 class="card-title">Field Trip Form</h4>
                <p class="card-text">Curabitur blandit tempus porttitor. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                <a href="{{ asset('/files/field.pdf') }}" download="" class="btn btn-primary">Download</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection