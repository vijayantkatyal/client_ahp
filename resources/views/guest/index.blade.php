@extends('_layouts.guest')
@section('title', 'Home')

@section('header')
@endsection

@section('content')

<div class="container-fluid p-0">
	<!-- Parallax Slider -->
	<div id="slider" class="parallax-slider" style="width:1200px;margin:0 auto;margin-bottom: 0px;">
		<!-- Slide 1 -->
		<div class="ls-slide" data-ls="duration:4000; transition2d:7;">
			<!-- background image  -->
			<img src="{{ asset('assets/img/slider/parallaxslider/slide1.jpg') }}" class="ls-bg" alt="" />
			<!-- clouds  -->
			<img src="{{ asset('assets/img/slider/parallaxslider/clouds.png') }}" class="ls-l" alt="" style="top:56px;left:-100px;" data-ls="parallax:true; parallaxlevel:-5;">
			<!-- butterflies  -->
			<img src="{{ asset('assets/img/slider/parallaxslider/butterflies.png') }}" class="ls-l" alt="" style="top:16px;left:0px;" data-ls=" parallax:true; parallaxlevel:4;">
			<!-- sun  -->
			<img src="{{ asset('assets/img/slider/parallaxslider/sun.png') }}" class="ls-l" alt="" style="top:-190px;left:650px;" data-ls="parallax:true; parallaxlevel:-3;">
			<!--child image  -->
			<img src="{{ asset('assets/img/slider/parallaxslider1.png') }}" class="ls-l" alt="" style="top:166px;left:520px;" data-ls="offsetxin:10; offsetyin:120; durationin:1100; rotatein:5; transformoriginin:59.3% 80.3% 0; offsetxout:-80; durationout:400; parallax:true; parallaxlevel:10;">
			<!-- text  -->
			<div class="ls-l header-wrapper" data-ls="offsetyin:150; durationin:700; delayin:200; easingin:easeOutQuint; rotatexin:20; scalexin:1.4; offsetyout:600; durationout:400;">
				<div class="header-text">
					<span>Welcome to</span>
					<h1>Alberta Hindi Parishad</h1>
					<!--the div below is hidden on small screens  -->
					<div class="hidden-small">
						<p class="header-p">We provide regular classes to teach Hindi systematically</p>
						<a class="btn btn-secondary" href="{{ route('get_admin_register_route') }}">Enrol Now</a>
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
						<h5 class="card-title text-light">Licensed Vidyalaya</h5>
						<p class="card-text">
							Hindi Vidyalaya was started in 1987 at the University of Alberta with the help of (late) Professor Emeritus Dr. Ambikeshwar Sharma
						</p>
						<!-- button show on mobile only,where flip is disabled -->
						<a href="contact.php" class="btn d-lg-none">Contact us</a>
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
							<h5 class="card-title text-light">Since 1987</h5>
							<p class="card-text">enas at arcu risus. Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id.
								In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat
							</p>
							<!-- button -->
							<a href="contact.php" class="btn">contact us</a>
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
						<h5 class="card-title text-light">High Quality learning</h5>
						<p class="card-text">
							In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat lorem
						</p>
						<!-- button show on mobile only,where flip is disabled -->
						<a href="services.php" class="btn d-lg-none">Our Services</a>
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
							<h5 class="card-title text-light">Quality Education</h5>
							<p class="card-text">enas at arcu risus. Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id.
								In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat
							</p>
							<!-- button -->
							<a href="services.php" class="btn">Our Services</a>
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
						<h5 class="card-title text-light">Talented Staff</h5>
						<p class="card-text">
							In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat lorem
						</p>
						<!-- button show on mobile only,where flip is disabled -->
						<a href="team.php" class="btn d-lg-none">Our Team</a>
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
							<h5 class="card-title text-light">Meet our Staff</h5>
							<p class="card-text">enas at arcu risus. Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id.
								In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat
							</p>
							<!-- button -->
							<a href="team.php" class="btn">Our Team</a>
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
				<h3>Our Mission</h3>
				<p class="mt-4 res-margin">
                    Alberta Hindi Parishad was founded in 1985 with main objective to provide regular classes to teach Hindi systematically. Hindi Vidyalaya was started in 1987 at the University of Alberta with the help of (late) Professor Emeritus Dr. Ambikeshwar Sharma. Alberta Hindi Parishad chose the books prepared and published by National Council of Educational Research and Training (NCERT)-Baal Bharati is used in the central school system throughout India, as the curriculum to structure the classes. Experienced teachers provide basic training and guidance to the volunteer teachers. Hindi Vidyalaya conducts five classes (levels 1 to 5) for children from 5 to 15 years old.
                </p>
                <p>
                    There are separate classes for adults where basic reading, writing and speaking is taught, followed by conversation class, where emphasis is on Hindi speaking and a class of grammar. Students participate in many programs like Holi, Independence Day, Kavi Sammelan, Hindi Divas, Antakshari, field trips and annual picnic. These programs are organized by Hindi Parishad. Students and members are encouraged to submit articles, poems and short stories our annual publication MEDHAVANI and newsletter KRITI.
                </p>
				<a href="contact.php" class="btn btn-secondary ">Contact us</a>
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
		<h3 class="mt-5 text-center">What Parents say:</h3>
		<div class="row">
			<!-- testimonials -->
			<!-- testimonial carousel -->
			<div class="carousel-2items owl-carousel owl-theme col-md-12">
				<!-- testimonial -->
				<div class="testimonial">
					<div class="content">
						<p class="description">
							Scelerisque laoreet nibh hendrerit id. In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat, nec elementum ipsum convall.
						</p>
					</div>
					<!-- /content -->
					<div class="testimonial-pic">
						<img src="{{ asset('assets/img/team/team1.jpg') }}" class="img-fluid" alt="">
					</div>
					<!-- /testimonial-pic -->
					<div class="testimonial-review">
						<h5 class="testimonial-title">Lucianna Smith</h5>
						<span class="post">Teacher</span>
					</div>
					<!-- /testimonial-review -->
				</div>
				<!-- /testimonial -->
				<!-- testimonial -->
				<div class="testimonial">
					<div class="content">
						<p class="description">
							Aliquam erat volutpat In id fermentum augue, ut pellentesque leo. Maecenas at arcu risus. Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id. In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat, nec elementum ipsum convall.
						</p>
					</div>
					<!-- /content -->
					<div class="testimonial-pic">
						<img src="{{ asset('assets/img/team/team2.jpg') }}" class="img-fluid" alt="">
					</div>
					<!-- /testimonial-pic -->
					<div class="testimonial-review">
						<h5 class="testimonial-title">John Sadana</h5>
						<span class="post">Doctor</span>
					</div>
					<!-- /testimonial-review -->
				</div>
				<!-- /testimonial -->
				<!-- testimonial -->
				<div class="testimonial">
					<div class="content">
						<p class="description">
							Aliquam erat volutpat In id fermentum augue, ut pellentesque leo. Maecenas at arcu risus. Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id. In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat, nec elementum ipsum convall.
						</p>
					</div>
					<!-- /content -->
					<div class="testimonial-pic">
						<img src="{{ asset('assets/img/team/team3.jpg') }}" class="img-fluid" alt="">
					</div>
					<!-- /testimonial-pic -->
					<div class="testimonial-review">
						<h5 class="testimonial-title">Jane Janeth</h5>
						<span class="post">Librarian</span>
					</div>
					<!-- /testimonial-review -->
				</div>
				<!-- /testimonial -->
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
<!-- section -->
<section id="features" class="bg-secondary text-light">
	<div class="container">
		<!-- section heading -->
		<div class="section-heading text-center">
			<h2>Our Features</h2>
			<p class="subtitle">Benefits for you</p>
		</div>
		<!-- /section-heading -->
		<!-- features -->
		<div class="row ">
			<div class="col-lg-6">
				<div class="row ">
					<div class="col-md-6 col-lg-6">
						<!-- feature -->
						<div class="feature-with-icon">
							<div class="icon-features">
								<!-- icon -->
								<i class="flaticon-maternity text-primary"></i>
							</div>
							<h5>Safe Enviroment</h5>
							<p>Etiam rhoncus leo a dolor placerat, nec elem entum ipsum convall.</p>
						</div>
						<!-- /feature-with-icon-->
						<!-- feature -->
						<div class="feature-with-icon mt-5">
							<div class="icon-features">
								<!-- icon -->
								<i class="flaticon-open-book-1 text-primary"></i>
							</div>
							<h5>Educational activities</h5>
							<p>Etiam rhoncus leo a dolor placerat, nec elem entum ipsum convall.</p>
						</div>
						<!-- /feature-with-icon-->
					</div>
					<div class="col-md-6 col-lg-6">
						<!-- feature -->
						<div class="feature-with-icon">
							<div class="icon-features">
								<!-- icon -->
								<i class="flaticon-classroom-1 text-primary"></i>
							</div>
							<h5>Qualified teachers</h5>
							<p>Etiam rhoncus leo a dolor placerat, nec elem entum ipsum convall.</p>
						</div>
						<!-- /feature-with-icon-->
						<!-- feature -->
						<div class="feature-with-icon mt-5">
							<div class="icon-features">
								<!-- icon -->
								<i class="flaticon-baby-boy text-primary"></i>
							</div>
							<h5>care</h5>
							<p>Etiam rhoncus leo a dolor placerat, nec elem entum ipsum convall.</p>
						</div>
						<!-- /feature-with-icon-->
					</div>
					<!-- /col-l -->
				</div>
				<!-- /row-->
			</div>
			<!-- /col-l -->
			<div class="col-lg-6 features-bg">
				<!-- image -->
				<img src="{{ asset('assets/img/features.png') }}" alt="" class="img-fluid" data-aos="zoom-out" data-aos-delay="300">
			</div>
			<!-- /col-l -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
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
						<div class="counter-value" data-count="30">0</div>
						<h3 class="title">Professionals</h3>
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
						<div class="counter-value" data-count="74">0</div>
						<h3 class="title">Happy parents</h3>
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
						<div class="counter-value" data-count="104">0</div>
						<h3 class="title">Students</h3>
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
<!-- /section ends--><!-- section-->
<section id="team-home" class="container">
	<!-- section heading -->
	<div class="section-heading text-center">
		<h2>Our Team</h2>
		<p class="subtitle">Qualified Professionals</p>
	</div>
	<!-- /section-heading -->
	<div class="row">
		<div class="col-lg-7">
			<h3>Meet our Talented Team</h3>
			<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<ul class="checkmark ps-0 font-weight-bold">
				<li>Over 30 Qualified professionals</li>
				<li>We offer you our quality services since 2002</li>
				<li>Fun and educational activities in our daily plan</li>
			</ul>
			<!-- /ul-->
		</div>
		<!-- /col-lg-->
		<div class="col-lg-5 res-margin">
			<img src="{{ asset('assets/img/team/team-home.jpg') }}" alt="" class="img-fluid blob2">
			<!-- ornament starts-->
			<div class="ornament-stars" data-aos="fade-down"></div>
		</div>
		<!-- /col-lg-->
		
	</div>
	<!-- /row-->
</section>
<!-- /section ends-->
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
			<!-- blog-box -->
			<div class="blog-box">
				<!-- image -->
				<a href="blog-single.php">
					<div class="image"><img src="http://ahpschool.ca/Ref/Events/2020/RepublicDay/9M%20.jpeg" alt=""></div>
				</a>
				<!-- blog-box-caption -->
				<div class="blog-box-caption">
					<!-- date -->
					<div class="date"><span class="day">12</span><span class="month">May</span></div>
					<a href="blog-single.php">
						<h4>Republic Day</h4>
					</a>
					<!-- /link -->
					<p>
						Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id. In aliquet magna nec lobortis...
					</p>
				</div>
				<!-- blog-box-footer -->
				<div class="blog-box-footer">
					<!-- Button -->
					<div class="text-center col-md-12">
						<a href="#" class="btn btn-primary ">Read more</a>
					</div>
				</div>
				<!-- /blog-box-footer -->
			</div>
			<!-- /blog-box -->
			<!-- blog-box -->
			<div class="blog-box">
				<!-- image -->
				<a href="blog-single.php">
					<div class="image"><img src="http://ahpschool.ca/Ref/Events/2020/Ilha/9M%20.jpeg" alt=""></div>
				</a>
				<!-- blog-box-caption -->
				<div class="blog-box-caption">
					<!-- date -->
					<div class="date"><span class="day">28</span><span class="month">June</span></div>
					<a href="blog-single.php">
						<h4>llha</h4>
					</a>
					<!-- /link -->
					<p>
						Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id. In aliquet magna nec lobortis...
					</p>
				</div>
				<!-- blog-box-footer -->
				<div class="blog-box-footer">
					<!-- Button -->
					<div class="text-center col-md-12">
						<a href="blog-single.php" class="btn btn-primary ">Read more</a>
					</div>
				</div>
				<!-- /blog-box-footer -->
			</div>
			<!-- /blog-box -->
			<!-- blog-box -->
			<div class="blog-box">
				<!-- image -->
				<a href="blog-single.php">
					<div class="image"><img src="{{ asset('assets/img/blog/blogstyle2-3.jpg') }}" alt=""></div>
				</a>
				<!-- blog-box-caption -->
				<div class="blog-box-caption">
					<!-- date -->
					<div class="date"><span class="day">02</span><span class="month">July</span></div>
					<a href="blog-single.php">
						<h4>20 Fun Activities to Do With Your Kids</h4>
					</a>
					<!-- /link -->
					<p>
						Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id. In aliquet magna nec lobortis...
					</p>
				</div>
				<!-- blog-box-footer -->
				<div class="blog-box-footer">
					<!-- Button -->
					<div class="text-center col-md-12">
						<a href="blog-single.php" class="btn btn-primary ">Read more</a>
					</div>
				</div>
				<!-- /blog-box-footer -->
			</div>
			<!-- /blog-box -->
			<!-- blog-box -->
			<div class="blog-box">
				<!-- image -->
				<a href="blog-single.php">
					<div class="image"><img src="{{ asset('assets/img/blog/blogstyle2-4.jpg') }}" alt=""></div>
				</a>
				<!-- blog-box-caption -->
				<div class="blog-box-caption">
					<!-- date -->
					<div class="date"><span class="day">18</span><span class="month">June</span></div>
					<a href="blog-single.php">
						<h4>Brain-Boosting Activities for Children</h4>
					</a>
					<!-- /link -->
					<p>
						Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id. In aliquet magna nec lobortis...
					</p>
				</div>
				<!-- blog-box-footer -->
				<div class="blog-box-footer">
					<div class="author">Posted by<a href="#"><i class="fas fa-user"></i>Jonas Doe</a></div>
					<div class="comments"><a href="blog-single.php"><i class="fas fa-comment"></i>11</a></div>
					<!-- Button -->
					<div class="text-center col-md-12">
						<a href="blog-single.php" class="btn btn-primary ">Read more</a>
					</div>
				</div>
				<!-- /blog-box-footer -->
			</div>
			<!-- /blog-box -->
		</div>
		<!-- /owl-carousel -->
	</div>
	<!-- /container -->
</section>
<!-- /section ends-->
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
					<h3>Enroll Today</h3>
					<p>Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus vi tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
					<a href="contact.php" class="btn btn-tertiary">Contact us</a>
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
					<div class="col-lg-4 contact-box">
						<div class="contact-icon bg-secondary text-light">
							<!---icon-->
							<i class="fa fa-envelope top-icon"></i>
							<!-- contact-icon info-->
							<div class="contact-icon-info">
								<h5>Write us</h5>
								<p><a href="mailto:albertahindischool@gmail.com">albertahindischool@gmail.com</a></p>
							</div>
						</div>
						<!-- /contact-icon-->
					</div>
					<!-- /col-lg-->
					<div class="col-lg-4 contact-box res-margin">
						<div class="contact-icon bg-secondary text-light">
							<!---icon-->
							<i class="fa fa-map-marker top-icon"></i>
							<!-- contact-icon info-->
							<div class="contact-icon-info">
								<h5>Visit us</h5>
								<p>#104, 3907-98 Street, Edmonton, Alberta, T6E 6M3</p>
							</div>
						</div>
						<!-- /contact-icon-->
					</div>
					<!-- /col-lg -->
					<div class="col-lg-4 contact-box res-margin">
						<div class="contact-icon bg-secondary text-light">
							<!---icon-->
							<i class="fa fa-phone top-icon"></i>
							<!-- contact-icon info-->
							<div class="contact-icon-info">
								<h5>Call us</h5>
								<p>(780) 432-3674</p>
							</div>
						</div>
						<!-- /contact-icon-->
					</div>
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
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label>Name<span class="required">*</span></label>
									<input type="text" name="name" class="form-control input-field" required="">
								</div>
								<div class="col-md-6">
									<label>Email Address <span class="required">*</span></label>
									<input type="email" name="email" class="form-control input-field" required="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label>Subject</label>
									<input type="text" name="subject" class="form-control input-field">
								</div>
								<div class="col-md-12">
									<label>Message<span class="required">*</span></label>
									<textarea name="message" id="message" class="textarea-field form-control" rows="3" required=""></textarea>
								</div>
							</div>
							<button type="submit" id="submit_btn" value="Submit" class="btn btn-tertiary">Send message</button>
						</div>
						<!-- /form-group-->
						<!-- Contact results -->
						<div id="contact_results"></div>
					</div>
					<!-- /contact-form-->
				</div>
				<!-- /contact-info-->
				<div class="col-lg-5">
					<!-- map-->
					<div id="map-canvas" class="mt-5 rounded"></div>
				</div>
				<!-- ornament starts-->
				<div class="ornament-stars mt-8 d-none d-md-block" data-aos="zoom-out"></div>
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
@endsection