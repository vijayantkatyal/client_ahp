@extends('_layouts.guest')
@section('title', 'Director(s) Duty Calendar')

@section('header')
@endsection

@section('content')

<div class="page container">
    <h2 class="element-heading col-lg-12">Director(s) Duty Calendar</h2>
    <br/>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>School Activity</th>
                        <th># of Classes</th>
                        <th>Director on Duty</th>
                        <th>Program / Activity (if any)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $event->date }}</td>
                            <td>{{ $event->school_activity }}</td>
                            <td>{{ $event->no_of_classes }}</td>
                            <td>{{ $event->director_on_duty }}</td>
                            <td>{{ $event->activity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection