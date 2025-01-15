@extends('_layouts.guest')
@section('title', 'Calendar')

@section('header')
@endsection

@section('content')

<div class="page container">
    <h2 class="element-heading col-lg-12">Calendars</h2>
    <br/>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card card-body">
                <h4 class="card-title">School Calendar</h4>
                <a href="{{ route('get_calendar_school') }}" class="btn btn-primary">View</a>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-body">
                <h4 class="card-title">Director Duty Calendar</h4>
                <a href="{{ route('get_calendar_director_duty') }}" class="btn btn-primary">View</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection