@extends('_layouts.guest')
@section('title', 'Home')

@section('header')

<style>
	.ls-wrapper.ls-in-out {
		left: 0px !important;
	}

	.parallax-slider .header-wrapper .header-text {
		background: rgba(255, 255, 255, 0.73);
        width: 50% !important;
        padding: 20px;
        border-radius: 20px;
        margin-top: 10%;
	}
</style>

@endsection

@section('content')

<div class="container-fluid p-0">
	<!-- Parallax Slider -->
	<div id="slider" class="parallax-slider" style="width:1200px;margin:0 auto;margin-bottom: 0px;">
		<!-- Slide 1 -->
		<div class="ls-slide" data-ls="duration:4000; transition2d:7;">
			<!-- background image  -->
			
			<!--child image  -->
			<img src="{{ asset('assets/img/slider/parallaxslider1.png') }}" class="ls-l" alt="" style="top:0px !important;left:0px !important;" data-ls="offsetxin:10; offsetyin:120; durationin:1100; rotatein:5; transformoriginin:59.3% 80.3% 0; offsetxout:-80; durationout:400; parallax:true; parallaxlevel:10;">
			<!-- text  -->
			<div class="ls-l header-wrapper" data-ls="offsetyin:150; durationin:700; delayin:200; easingin:easeOutQuint; rotatexin:20; scalexin:1.4; offsetyout:600; durationout:400;">
				<div class="header-text">
					<h1>{{ App\Models\Site::getItem($page->page_schema, 'slider', 'title') }}</h1>
					<!--the div below is hidden on small screens  -->
					<div class="hidden-small">
						<p class="header-p">{{ App\Models\Site::getItem($page->page_schema, 'slider', 'sub_title') }}</p>
						<a class="btn btn-secondary" href="{{ App\Models\Site::getItem($page->page_schema, 'slider', 'link_url') }}">{{ App\Models\Site::getItem($page->page_schema, 'slider', 'link_title') }}</a>
					</div>
					<!--/hidden-small -->
				</div>
				<!-- header-text  -->
			</div>
			<!-- ls-l  -->
		</div>
		<!-- ls-slide -->
	</div>
	<!-- /slider -->
	<svg version="1.1" id="divider" class="slider-divider" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1440 126" preserveAspectRatio="none slice" xml:space="preserve">
		<path class="st0" d="M685.6,38.8C418.7-11.1,170.2,9.9,0,30v96h1440V30C1252.7,52.2,1010,99.4,685.6,38.8z"></path>
	</svg>
</div>
<!-- /container-fluid -->
<!-- ==== Page Content ==== -->
<div class="container">
	<!-- section -->
	<section id="intro-cards" class="row pb-0">
		<!-- card 1 -->
		<div class="col-lg-4" data-aos="zoom-out">
			<div class="card card-flip">
				<!-- front of card  -->
				<div class="card bg-secondary text-light ">
					<div class="p-5">
						<h5 class="card-title text-light">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[0]->title }}</h5>
						<p class="card-text">
							{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[0]->sub_title }}
						</p>
						<!-- button show on mobile only,where flip is disabled -->
						<a href="{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'features')[0]->summary_link_url }}" class="btn d-lg-none">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[0]->summary_link_title }}</a>
					</div>
					<!-- /p-5 -->
					<!-- image -->
					<img class="card-img" src="{{ asset('assets/img/intro1.jpg') }}" alt="">
				</div>
				<!-- /card -->
				<!-- back of card -->
				<div class="card bg-secondary text-light card-back">
					<div class="card-body d-flex justify-content-center align-items-center">
						<div class="p-4">
							<h5 class="card-title text-light">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[0]->summary_title }}</h5>
							<p class="card-text">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[0]->summary_description }}</p>
							<!-- button -->
							<a href="{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'features')[0]->summary_link_url }}" class="btn">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[0]->summary_link_title }}</a>
						</div>
						<!-- /p-4 -->
					</div>
					<!-- /card-body -->
				</div>
				<!-- /card -->
			</div>
			<!--/col-lg -->
		</div>
		<!--/card 1 -->
		<!-- card 2-->
		<div class="col-lg-4" data-aos="zoom-out" data-aos-delay="300">
			<div class="card card-flip ">
				<!-- front of card  -->
				<div class="card bg-primary text-light">
					<div class="p-5">
						<h5 class="card-title text-light">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[1]->title }}</h5>
						<p class="card-text">
							{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[1]->sub_title }}
						</p>
						<!-- button show on mobile only,where flip is disabled -->
						<a href="{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'features')[1]->summary_link_url }}" class="btn d-lg-none">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[0]->summary_link_title }}</a>
					</div>
					<!-- /p-5 -->
					<!-- image -->
					<img class="card-img" src="{{ asset('assets/img/intro2.jpg') }}" alt="">
				</div>
				<!-- /card -->
				<!-- back of card -->
				<div class="card bg-primary text-light card-back">
					<div class="card-body d-flex justify-content-center align-items-center">
						<div class="p-4">
							<h5 class="card-title text-light">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[1]->summary_title }}</h5>
							<p class="card-text">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[1]->summary_description }}</p>
							<!-- button -->
							<a href="{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'features')[1]->summary_link_url }}" class="btn">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[1]->summary_link_title }}</a>
						</div>
						<!-- /p-4 -->
					</div>
					<!-- /card-body -->
				</div>
				<!-- /card -->
			</div>
			<!--/card 2 -->
		</div>
		<!--/col-lg -->
		<!-- card 3-->
		<div class="col-lg-4" data-aos="zoom-out" data-aos-delay="600">
			<div class="card card-flip ">
				<!-- front of card  -->
				<div class="card bg-tertiary text-light">
					<div class="p-5">
						<h5 class="card-title text-light">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[2]->title }}</h5>
						<p class="card-text">
							{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[2]->sub_title }}
						</p>
						<!-- button show on mobile only,where flip is disabled -->
						<a href="{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'features')[2]->summary_link_url }}" class="btn d-lg-none">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[2]->summary_link_title }}</a>
					</div>
					<!-- /p-5 -->
					<!-- image -->
					<img class="card-img" src="{{ asset('assets/img/intro3.jpg') }}" alt="">
				</div>
				<!-- /card -->
				<!-- back of card -->
				<div class="card bg-tertiary text-light card-back">
					<div class="card-body d-flex justify-content-center align-items-center">
						<div class="p-4">
							<h5 class="card-title text-light">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[2]->summary_title }}</h5>
							<p class="card-text">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[2]->summary_description }}</p>
							<!-- button -->
							<a href="{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'features')[2]->summary_link_url }}" class="btn">{{ App\Models\Site::getItemCollectionParent($page->page_schema, "features")[2]->summary_link_title }}</a>
						</div>
						<!-- /p-4 -->
					</div>
					<!-- /card-body -->
				</div>
				<!-- /card -->
			</div>
			<!--/card 3 -->
		</div>
		<!--/col-lg -->
	</section>
	<!-- #intro-cards -->
</div>
<!-- /container -->
<!-- section -->
<section id="about-home" class="container-fluid pb-0">
	<div class="container">
		<!-- section heading -->
		<div class="section-heading text-center">
			<h2>About Us</h2>
			<p class="subtitle">Get to know us</p>
		</div>
		<!-- /section-heading -->
		<div class="row">
			<div class="col-lg-7 ">
				<h3>{{ App\Models\Site::getItem($page->page_schema, 'about_us', 'title') }}</h3>
				<p class="mt-4 res-margin">
					{!! App\Models\Site::getItem($page->page_schema, 'about_us', 'summary') !!}
                </p>
				<a href="{{ App\Models\Site::getItem($page->page_schema, 'about_us', 'link_url') }}" class="btn btn-secondary ">{{ App\Models\Site::getItem($page->page_schema, 'about_us', 'link_title') }}</a>
			</div>
			<!-- /col-lg -->
			<div class="col-lg-5 res-margin">
				<!-- image -->
				<img class="img-fluid rounded" src="{{ asset('assets/img/about/about2.jpg') }}" alt="">
				<!-- ornament starts-->
				<div class="ornament-rainbow" data-aos="zoom-out"></div>
			</div>
			<!-- /col-lg -->
		</div>
		<!-- /row -->
		<h3 class="mt-5 text-center">{{ App\Models\Site::getItem($page->page_schema, 'testimonials', 'title') }}</h3>
		<div class="row">
			<!-- testimonials -->
			<!-- testimonial carousel -->
			<div class="carousel-2items owl-carousel owl-theme col-md-12">
				@foreach(App\Models\Site::getItemCollection($page->page_schema, "testimonials", "reviews") as $reviewItemKey => $reviewItemValue)
				<div class="testimonial">
					<div class="content">
						<p class="description">
							{{ $reviewItemValue->summary }}
						</p>
					</div>
					<!-- /content -->
					<!-- /testimonial-pic -->
					<div class="testimonial-review">
						<h5 class="testimonial-title">{{ $reviewItemValue->name }}</h5>
						<span class="post">{{ $reviewItemValue->title }}</span>
					</div>
					<!-- /testimonial-review -->
				</div>
				@endforeach
			</div>
			<!-- /owl-testimonial -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container-->
	<!-- whale in water scene -->
	<!-- whale -->
	<img src="{{ asset('assets/img/ornaments/whale.png') }}" class="floating-whale" alt="">
	<!-- waves -->
	<div class="waveHorizontals">
		<div id="waveHorizontal1" class="waveHorizontal"></div>
		<div id="waveHorizontal2" class="waveHorizontal"></div>
		<div id="waveHorizontal3" class="waveHorizontal"></div>
	</div>
	<!-- sea -->
	<div class="sea"></div>
	<!--/ whale in water scene ends -->
</section>
<!-- /section ends -->

<!-- Section  -->
<section id="counter-section" class="container-fluid counter-calltoaction bg-fixed overlay" data-100-bottom="background-position: 50% 100px;" data-top-bottom="background-position: 50% -100px;">
	<div id="counter" class="container">
		<div class="row col-lg-10 offset-lg-1">
			<!-- Counter -->
			<div class="col-xl-4 col-md-4">
				<div class="counter">
					<div class="counter-wrapper bg-primary">
						<i class="counter-icon flaticon-teacher"></i>
						<!-- insert your final value on data-count= -->
						<div class="counter-value" data-count="{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'stats')[0]->count }}">0</div>
						<h3 class="title">{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'stats')[0]->title }}</h3>
					</div>
				</div>
				<!-- /counter -->
			</div>
			<!-- /col-lg -->
			<!-- Counter -->
			<div class="col-xl-4 col-md-4">
				<div class="counter">
					<div class="counter-wrapper bg-secondary">
						<i class="counter-icon  flaticon-family"></i>
						<!-- insert your final value on data-count= -->
						<div class="counter-value" data-count="{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'stats')[1]->count }}">0</div>
						<h3 class="title">{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'stats')[1]->title }}</h3>
					</div>
				</div>
				<!-- /counter -->
			</div>
			<!-- /col-lg -->
			<!-- Counter -->
			<div class="col-xl-4 col-md-4">
				<div class="counter">
					<div class="counter-wrapper bg-tertiary">
						<i class="counter-icon flaticon-children"></i>
						<!-- insert your final value on data-count= -->
						<div class="counter-value" data-count="{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'stats')[2]->count }}">0</div>
						<h3 class="title">{{ App\Models\Site::getItemCollectionParent($page->page_schema, 'stats')[2]->title }}</h3>
					</div>
				</div>
				<!-- /counter -->
			</div>
			<!-- /col-lg -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</section>
<!-- /section ends-->
@if(count($posts) > 0)
<!-- section -->
<section id="blogprev-home" data-100-bottom="background-position: 0% 120%;" data-top-bottom="background-position: 0% 100%;">
	<div class="container">
		<!-- section heading -->
		<div class="section-heading text-center">
			<h2>Latest Blog Posts</h2>
			<p class="subtitle">Our Updates</p>
		</div>
		<!-- /section-heading -->
		<!-- blog carousel -->
		<div class="carousel-3items owl-carousel owl-theme mt-0">
			@foreach($posts as $post)
			<div class="blog-box">
				<!-- image -->
				<a href="{{ route('get_post', ['name' => $post->name]) }}">
					@if($post->image != null)
						<div class="image"><img src="{{ asset($post->image) }}" alt=""></div>
					@else
						<div class="image"><img src="https://placehold.co/600x400?text=AHP" alt=""></div>
					@endif
				</a>
				<!-- blog-box-caption -->
				<div class="blog-box-caption">
					<!-- date -->
					<div class="date" style="padding: 8px;">{{ $post->created_at }}</div>
					<a href="{{ route('get_post', ['name' => $post->name]) }}">
						<h4>{{ $post->title }}</h4>
					</a>
					<!-- /link -->
					<p>
						{{ $post->summary }}
					</p>
				</div>
				<!-- blog-box-footer -->
				<div class="blog-box-footer">
					<!-- Button -->
					<div class="text-center col-md-12">
						<a href="{{ route('get_post', ['name' => $post->name]) }}" class="btn btn-primary ">Read more</a>
					</div>
				</div>
				<!-- /blog-box-footer -->
			</div>
			@endforeach
		</div>
		<!-- /owl-carousel -->
	</div>
	<!-- /container -->
</section>
<!-- /section ends-->
 @endif
<!-- section -->
<section id="callout" class=" container-fluid bg-fixed">
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-lg-6 p-0" data-start="right: 50%;" data-center="right:-5%;">
				<!-- image  -->
				<img src="{{ asset('assets/img/call-to-action/calltoactionbg.jpg') }}" class="img-fluid img-rounded" alt="">
			</div>
			<!-- text box  -->
			<div class="col-lg-6 bg-secondary p-5 justify-content-center align-self-center" data-start="left: 50%;" data-center="left:-5%;">
				<div class="text-light justify-content-center align-self-center">
					<h3>{{ App\Models\Site::getItem($page->page_schema, 'enroll', 'title') }}</h3>
					<p>{{ App\Models\Site::getItem($page->page_schema, 'enroll', 'summary') }}</p>
					<a href="{{ App\Models\Site::getItem($page->page_schema, 'enroll', 'link_url') }}" class="btn btn-tertiary">{{ App\Models\Site::getItem($page->page_schema, 'enroll', 'link_title') }}</a>
				</div>
				<!-- /text-light  -->
			</div>
			<!-- /col-lg  -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</section>
<!-- /section ends -->
<!-- Section -->
<section id="contact-home" class="container">
	<div class="row">
		<div class="col-lg-10 offset-lg-1 text-center">
			<!-- section heading -->
			<div class="section-heading text-center">
				<h2>Contact Us</h2>
				<p class="subtitle">Get in Touch</p>
			</div>
			<!-- /section-heading -->
			<!-- contact info boxes start-->
			<div class="contact-info res-margin">
				<div class="row res-margin">
					@if(App\Models\Site::settings()['support_email'] != null)
					<div class="col-lg-4 contact-box">
						<div class="contact-icon bg-secondary text-light">
							<!---icon-->
							<i class="fa fa-envelope top-icon"></i>
							<!-- contact-icon info-->
							<div class="contact-icon-info">
								<h5>Write us</h5>
								<p><a href="mailto:{{ App\Models\Site::settings()['support_email'] }}">{{ App\Models\Site::settings()['support_email'] }}</a></p>
							</div>
						</div>
						<!-- /contact-icon-->
					</div>
					@endif
					<!-- /col-lg-->
					@if(App\Models\Site::settings()['address'] != null)
					<div class="col-lg-4 contact-box res-margin">
						<div class="contact-icon bg-secondary text-light">
							<!---icon-->
							<i class="fa fa-map-marker top-icon"></i>
							<!-- contact-icon info-->
							<div class="contact-icon-info">
								<h5>Visit us</h5>
								<p>{{ App\Models\Site::settings()['address'] }}</p>
							</div>
						</div>
						<!-- /contact-icon-->
					</div>
					@endif
					<!-- /col-lg -->
					@if(App\Models\Site::settings()['phone'] != null)
					<div class="col-lg-4 contact-box res-margin">
						<div class="contact-icon bg-secondary text-light">
							<!---icon-->
							<i class="fa fa-phone top-icon"></i>
							<!-- contact-icon info-->
							<div class="contact-icon-info">
								<h5>Call us</h5>
								<p>{{ App\Models\Site::settings()['phone'] }}</p>
							</div>
						</div>
						<!-- /contact-icon-->
					</div>
					@endif
					<!-- /col-lg-->
				</div>
				<!-- /row -->
			</div>
			<!-- /contact-info-->
		</div>
		<!-- /col-lg-->
		<!--notepad -->
		<div class="col-lg-12 mt-5 block-padding force notepad pl-5 pr-5">
			<div class="row">
				<div class="col-lg-7">
					<!-- contact-info-->
					<h4>Send us a message</h4>
					<!-- Form Starts -->
					<div id="contact_form">
						<form class="form-group" action="{{ route('post_contact') }}" method="post">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
									<label>Name<span class="required">*</span></label>
									<input type="text" name="name" required class="form-control input-field" required="">
								</div>
								<div class="col-md-6">
									<label>Email Address <span class="required">*</span></label>
									<input type="email" name="email" required class="form-control input-field" required="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label>Phone</label>
									<input type="text" name="phone" class="form-control input-field">
								</div>
								<div class="col-md-12">
									<label>Message<span class="required">*</span></label>
									<textarea name="message" required maxlength="500" id="message" class="textarea-field form-control" rows="3" required=""></textarea>
								</div>
							</div>
							<button type="submit" id="submit_btn" value="Submit" class="btn btn-tertiary">Send message</button>
						</form>
						<!-- /form-group-->
						<!-- Contact results -->
						<div id="contact_results"></div>
					</div>
					<!-- /contact-form-->
				</div>
				<!-- /contact-info-->
				@if(App\Models\Site::settings()['maps_link'] != null)
				<div class="col-lg-5">
					<!-- map-->
					<!-- <div id="map-canvas" class="mt-5 rounded"></div> -->
					<iframe
						width="100%"
  						height="400"
  						frameborder="0" style="border:0"
  						referrerpolicy="no-referrer-when-downgrade"
						src="{{ App\Models\Site::settings()['maps_link'] }}"
						allowfullscreen
					></iframe>
				</div>
				@endif
				<!-- ornament starts-->
				<!-- <div class="ornament-stars mt-8 d-none d-md-block" data-aos="zoom-out"></div> -->
			</div>
			<!-- /row-->
		</div>
		<!-- /col-lg-->
	</div>
	<!-- /.row-->
</section>
<!-- /Section -->

@endsection

@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js" integrity="sha512-hUhvpC5f8cgc04OZb55j0KNGh4eh7dLxd/dPSJ5VyzqDWxsayYbojWyl5Tkcgrmb/RVKCRJI1jNlRbVP4WWC4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	$(".date").each(function(){
		var _e_time = $(this).text();
		var _time = moment(_e_time);
		var _title = _time.format("DD MMM, YYYY");
		$(this).attr("title", _title);
		$(this).text(_title);
	});
</script>
@endsection