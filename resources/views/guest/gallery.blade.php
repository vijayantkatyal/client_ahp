@extends('_layouts.guest')
@section('title', 'Gallery')

@section('header')
@endsection

@section('content')

<div class="page container">
    <!-- /row -->
    <!-- centered Gallery navigation -->
    <!-- <ul class="nav nav-pills category-isotope center-nav">
        <li class="nav-item">
            <a class="nav-link active" href="#" data-toggle="tab" data-filter="*">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="tab" data-filter=".school">Our School</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="tab" data-filter=".activities">Activities</a>
        </li>
    </ul> -->
    <!-- /ul -->
    <!-- Gallery -->
    <div id="gallery-isotope" class="row mt-5 magnific-popup">
        <!-- Image 1 -->
        @foreach($photos as $photo)
        <div class="col-sm-6 col-md-6 col-lg-4 activities">
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
    @if($total > 9)
    <div class="text-center">
        @for($i = 0; $i < ($total / 9); $i++)
            <a href="{{ route('get_gallery') }}?page={{ $i+1 }}" @if($i+1 == $current_page) class="btn btn-primary" @else class="btn btn-danger" @endif>Page {{ $i + 1 }}</a>
        @endfor
    </div>
    @endif
</div>
<!-- /page --></div>

@endsection

@section('footer')
@endsection