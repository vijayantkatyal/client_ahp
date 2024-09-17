@extends('_layouts.guest')
@section('title', 'Event Details')

@section('header')
@endsection

@section('content')

<div class="page container">
    <div class="row">
        <div class="col-lg-6 text-center offset-lg-3 mb-5">
            <h2>{{ $event->name }} ({{ $event->date }})</h2>
            <p>{{ $event->description }}</p>
        </div>
        <!-- /col-lg -->
    </div>
    <!-- /row -->
    <!-- /ul -->
    <!-- Gallery -->
    <div id="gallery-isotope" class="row mt-5 magnific-popup">
        <!-- Image 1 -->
        @foreach($photos as $photo)
        <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="{{ asset($photo->photo) }}" alt="">
                    <span class="overlay-mask"></span>
                    <a href="{{ asset($photo->photo) }}" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($total > 9)
    <div class="text-center">
        @for($i = 0; $i < ($total / 9); $i++)
            <a href="{{ route('get_event_details', $event->id) }}?page={{ $i+1 }}" @if($i+1 == $current_page) class="btn btn-primary" @else class="btn btn-danger" @endif>Page {{ $i + 1 }}</a>
        @endfor
    </div>
    @endif
    
    <!-- /gallery-isotope-->
</div>
<!-- /page --></div>

@endsection

@section('footer')
@endsection