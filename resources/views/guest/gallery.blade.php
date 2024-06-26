@extends('_layouts.guest')
@section('title', 'Gallery')

@section('header')
@endsection

@section('content')

<div class="page container">
    <div class="row">
        <div class="col-lg-6 text-center offset-lg-3 mb-5">
            <h2>Our Photo Gallery</h2>
            <p>In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat, nec elementum ipsum convall.</p>
        </div>
        <!-- /col-lg -->
    </div>
    <!-- /row -->
    <!-- centered Gallery navigation -->
    <ul class="nav nav-pills category-isotope center-nav">
        <li class="nav-item">
            <a class="nav-link active" href="#" data-toggle="tab" data-filter="*">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="tab" data-filter=".school">Our School</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="tab" data-filter=".activities">Activities</a>
        </li>
    </ul>
    <!-- /ul -->
    <!-- Gallery -->
    <div id="gallery-isotope" class="row mt-5 magnific-popup">
        <!-- Image 1 -->
        <div class="col-sm-6 col-md-6 col-lg-4 activities">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/images/school1.jpg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/images/school1.jpg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        <!-- Image 2 -->
        <div class="col-sm-6 col-md-6 col-lg-4 school">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/Events/2020/RepublicDay/9M%20.jpeg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/Events/2020/RepublicDay/9M%20.jpeg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        <!-- Image 3 -->
        <div class="col-sm-6 col-md-6 col-lg-4 school">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/Events/2020/RepublicDay/7M.jpeg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/Events/2020/RepublicDay/7M.jpeg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        <!-- Image 4 -->
        <div class="col-sm-6 col-md-6 col-lg-4 activities">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/Events/2020/Ilha/9M%20.jpeg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/Events/2020/Ilha/9M%20.jpeg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        <!-- Image 5 -->
        <div class="col-sm-6 col-md-6 col-lg-4 school">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/Events/2020/Ilha/5M%20.jpeg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/Events/2020/Ilha/5M%20.jpeg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        <!-- Image 6 -->
        <div class="col-sm-6 col-md-6 col-lg-4 school">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/Events/2019/PDSession/9%20(2).jpeg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/Events/2019/PDSession/9%20(2).jpeg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        <!-- Image 7 -->
        <div class="col-sm-6 col-md-6 col-lg-4 activities">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/Events/2019/PDSession/8%20(1).jpeg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/Events/2019/PDSession/8%20(1).jpeg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        <!-- Image 8 -->
        <div class="col-sm-6 col-md-6 col-lg-4 activities">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/Events/2019/PDSession/7.jpeg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/Events/2019/PDSession/7.jpeg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        <!-- Image 9 -->
        <div class="col-sm-6 col-md-6 col-lg-4 school">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/Events/2019/KaviSamelan/9.jpg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/Events/2019/KaviSamelan/9.jpg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        <!-- Image 10 -->
        <div class="col-sm-6 col-md-6 col-lg-4 school">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/Events/2019/KaviSamelan/8.jpg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/Events/2019/KaviSamelan/8.jpg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        <!-- Image 11 -->
        <div class="col-sm-6 col-md-6 col-lg-4 school">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/Events/2019/KaviSamelan/7.jpg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/Events/2019/KaviSamelan/7.jpg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
        <!-- Image 12 -->
        <div class="col-sm-6 col-md-6 col-lg-4 school">
            <div class="portfolio-item">
                <div class="gallery-thumb">
                    <img class="img-fluid " src="http://ahpschool.ca/Ref/Events/2019/KaviSamelan/64.jpg" alt="">
                    <span class="overlay-mask"></span>
                    <a href="http://ahpschool.ca/Ref/Events/2019/KaviSamelan/64.jpg" class="link centered" title="You can add caption to pictures.">
                        <i class="fa fa-expand"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /gallery-isotope-->
</div>
<!-- /page --></div>

@endsection

@section('footer')
@endsection