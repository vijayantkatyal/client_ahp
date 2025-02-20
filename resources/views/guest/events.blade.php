@extends('_layouts.guest')
@section('title', 'Events')

@section('header')
@endsection

@section('content')

<div id="blog-home" class="page">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h2>Events</h2>
            </div>
            <div class="col-4 text-end">
                Show by Year:&nbsp;&nbsp;
                <select name="filter_year" id="" class="form-select" style="display: inline; width: 100px;">
                    <option @if($filter == "") selected @endif value="">All</option>
                    @foreach($years as $year)
                        <option @if($filter == $year) selected @endif value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @foreach($events as $event)
                    <div class="col-lg-6 res-margin mb-lg-5">
                        <!-- blog-box -->
                        <div class="blog-box">
                            <!-- image -->
                            <a href="{{ route('get_event_details', ['id' => $event->id]) }}">
                                <div class="image"><img src="{{ asset($event->first_image) }}" alt=""></div>
                            </a>
                            <!-- blog-box-caption -->
                            <div class="blog-box-caption">
                                <!-- date -->
                                <div class="date">
                                    <span class="day">{{ date('Y', strtotime($event->date)) }}</span><span class="month">{{ date('F', strtotime($event->date)) }}</span>
                                </div>
                                <a href="{{ route('get_event_details', ['id' => $event->id]) }}">
                                    <h4>{{ $event->name }}</h4>
                                </a>
                                <!-- /link -->
                                <p>
                                    {{ $event->description }}
                                </p>
                            </div>
                            <!-- blog-box-footer -->
                            <div class="blog-box-footer">
                                <!-- Button -->
                                <div class="text-center col-md-12">
                                    <a href="{{ route('get_event_details', ['id' => $event->id]) }}" class="btn btn-primary">Read more</a>
                                </div>
                            </div>
                            <!-- /blog-box-footer -->
                        </div>
                        <!-- /blog-box -->
                    </div>
                    @endforeach
                </div>
                <!-- /row -->
                <div class="col-md-12 mt-5 d-none">
                    <!-- pagination -->
                    <nav aria-label="pagination">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                    <!-- /nav -->
                </div>
                <!-- /col-md -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script>
    $("select[name=filter_year]").change(function(e){
        var _year = $(this).val();
        window.location = "{{ route('get_events') }}?year="+_year;
    })
</script>
@endsection