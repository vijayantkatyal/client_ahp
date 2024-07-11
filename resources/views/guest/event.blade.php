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
    <!-- /gallery-isotope-->
</div>
<!-- /page --></div>

@endsection

@section('footer')
@endsection