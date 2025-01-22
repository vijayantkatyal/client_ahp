@extends('_layouts.guest')
@section('title', 'About')

@section('header')
@endsection

@section('content')

<br/><br/><br/>

<div class="row">
	<!-- page with sidebar starts -->
	<div class="col-12">
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-lg-6 ">
					<h2>{{ App\Models\Site::getItem($page->page_schema, 'about_us', 'title') }}</h2>
					<p class="mt-4 res-margin">{!! App\Models\Site::getItem($page->page_schema, 'about_us', 'summary') !!}</p>
				</div>
				<!-- /col-lg-->
				<div class="col-lg-6 ">
					<!-- image -->
					<img class="img-fluid rounded" src="{{ asset('/assets/img/about/about2.jpg') }}" alt="">
					<!-- ornament starts-->
					<div class="ornament-rainbow" data-aos="zoom-out"></div>
				</div>
				<!-- /col-lg -->
			</div>
			<!-- /row -->
			<!-- /row -->
			<h3 class="mt-5">{{ App\Models\Site::getItem($page->page_schema, 'testimonials', 'title') }}</h3>
			<!-- divider -->
			<div class="row mt-5 ">
				<!-- testimonials -->
				<!-- testimonial carousel -->
				<div class="carousel-2items owl-carousel owl-theme col-md-12">
					@foreach(App\Models\Site::getItemCollection($page->page_schema, "testimonials", "reviews") as $reviewItemKey => $reviewItemValue)	
					<!-- testimonial -->
					<div class="testimonial">
						<div class="content">
							<p class="description">
								{{ $reviewItemValue->summary }}
							</p>
						</div>
						<!-- /testimonial-pic -->
						<div class="testimonial-review">
							<h5 class="testimonial-title">{{ $reviewItemValue->name }}</h5>
							<span class="post">{{ $reviewItemValue->title }}</span>
						</div>
						<!-- /testimonial-review -->
					</div>
					<!-- /testimonial -->
					@endforeach
				</div>
				<!-- /owl-testimonial -->
			</div>
			<!-- /row -->
			<div class="mt-5">
				<!-- call to action -->
				<div class="enroll-calltoaction col-md-12 card bg-tertiary text-light no-bg-small">
					<div class="text-center p-3">
						<div class="col-lg-8 offset-lg-4">
							<h4>{{ App\Models\Site::getItem($page->page_schema, 'enroll', 'title') }}</h4>
							<p>{{ App\Models\Site::getItem($page->page_schema, 'enroll', 'summary') }}</p>
							<!-- Button -->
							<div class="text-center">
								<a href="{{ App\Models\Site::getItem($page->page_schema, 'enroll', 'link_url') }}" class="btn btn-primary mt-2">{{ App\Models\Site::getItem($page->page_schema, 'enroll', 'link_title') }}</a>
							</div>
							<!-- /text-center -->
						</div>
						<!-- /col-md-8 -->
					</div>
					<!-- /text-center -->
				</div>
				<!-- /calltoaction -->
			</div>
			<!-- /mt-5 -->
		</div>
		<!-- /container -->
	</div>
	<!-- /page-with-sidebar -->
</div>
<!-- /row -->

@endsection

@section('footer')
@endsection