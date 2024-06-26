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
					<h2>Our Mission</h2>
					<span class="h7 mt-2">We Teach Hindi systematically</span>
					<p class="mt-4 res-margin">Alberta Hindi Parishad was founded in 1985 with main objective to provide regular classes to teach Hindi systematically. Hindi Vidyalaya was started in 1987 at the University of Alberta with the help of (late) Professor Emeritus Dr. Ambikeshwar Sharma. Alberta Hindi Parishad chose the books prepared and published by National Council of Educational Research and Training (NCERT)-Baal Bharati is used in the central school system throughout India, as the curriculum to structure the classes. Experienced teachers provide basic training and guidance to the volunteer teachers. Hindi Vidyalaya conducts five classes (levels 1 to 5) for children from 5 to 15 years old.</p>
					<p>There are separate classes for adults where basic reading, writing and speaking is taught, followed by conversation class, where emphasis is on Hindi speaking and a class of grammar. Students participate in many programs like Holi, Independence Day, Kavi Sammelan, Hindi Divas, Antakshari, field trips and annual picnic. These programs are organized by Hindi Parishad. Students and members are encouraged to submit articles, poems and short stories our annual publication MEDHAVANI and newsletter KRITI.</p>
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
			<h3 class="mt-5">Our Features</h3>
			<p>Aliquam erat volutpat In id fermentum augue, ut pellentesque leo. Maecenas at arcu risus. Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id. In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat, nec elementum ipsum convall.</p>
			<!-- row -->
			<div class="row">
				<div class="carousel-2items card bg-light owl-carousel owl-theme">
					<!-- feature -->
					<div class="feature-with-icon">
						<div class="icon-features">
							<!-- icon -->
							<i class="flaticon-maternity text-primary"></i>
						</div>
						<h5>Safe Enviroment</h5>
						<p>Aliquam erat volutpat In id fermentum augue, ut pellentesque leo. Etiam rhoncus leo a dolor placerat, nec elem entum ipsum convall.</p>
					</div>
					<!-- /feature-with-icon-->
					<!-- feature -->
					<div class="feature-with-icon">
						<div class="icon-features">
							<!-- icon -->
							<i class="flaticon-open-book-1 text-secondary"></i>
						</div>
						<h5>Educational activities</h5>
						<p>Aliquam erat volutpat In id fermentum augue, ut pellentesque leo. Etiam rhoncus leo a dolor placerat, nec elem entum ipsum convall.</p>
					</div>
					<!-- /feature-with-icon-->
					<!-- feature -->
					<div class="feature-with-icon">
						<div class="icon-features">
							<!-- icon -->
							<i class="flaticon-classroom-1 text-primary"></i>
						</div>
						<h5>Qualified teachers</h5>
						<p>Aliquam erat volutpat In id fermentum augue, ut pellentesque leo. Etiam rhoncus leo a dolor placerat, nec elem entum ipsum convall.</p>
					</div>
					<!-- /feature-with-icon-->
					<!-- feature -->
					<div class="feature-with-icon">
						<div class="icon-features">
							<!-- icon -->
							<i class="flaticon-baby-boy text-tertiary"></i>
						</div>
						<h5>Infant care</h5>
						<p>Aliquam erat volutpat In id fermentum augue, ut pellentesque leo. Etiam rhoncus leo a dolor placerat, nec elem entum ipsum convall.</p>
					</div>
					<!-- /feature-with-icon-->
				</div>
				<!-- /carousel-->
			</div>
			<!-- /row -->
			<h3 class="mt-5">What parents say</h3>
			<p>Aliquam erat volutpat In id fermentum augue, ut pellentesque leo. Maecenas at arcu risus. Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id. In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat, nec elementum ipsum convall.</p>
			<!-- divider -->
			<div class="row mt-5 ">
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
							<img src="{{ asset('/assets/img/team/team1.jpg') }}" class="img-fluid" alt="">
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
							<img src="{{ asset('/assets/img/team/team2.jpg') }}" class="img-fluid" alt="">
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
							<img src="{{ asset('/assets/img/team/team3.jpg') }}" class="img-fluid" alt="">
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
			<div class="mt-5">
				<!-- call to action -->
				<div class="enroll-calltoaction col-md-12 card bg-tertiary text-light no-bg-small">
					<div class="text-center p-3">
						<div class="col-lg-8 offset-lg-4">
							<h4>Join Us</h4>
							<p>Aliquam erat volutpat In id fermentum augue, ut pellentesque leo. Maecenas at arcu risus. Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id lorem ipsuet.</p>
							<!-- Button -->
							<div class="text-center">
								<a href="contact.php" class="btn btn-primary mt-2">Enroll today</a>
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