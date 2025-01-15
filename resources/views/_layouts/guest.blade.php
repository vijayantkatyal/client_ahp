<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- page title -->
	<title>{{ App\Models\Site::settings()['name'] }} : @yield('title')</title>
	<!--[if lt IE 9]>
      <script src="js/respond.js"></script>
      <![endif]-->
	<!-- Font files -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700%7CNunito:400,700,900&display=swap" rel="stylesheet">
	<link href="{{ asset('assets/fonts/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/fonts/fontawesome/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css">
	<!-- Fav icons -->
	<link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- style CSS -->
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	<!-- plugins CSS -->
	<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet">
	<!-- Colors CSS -->
	<link href="{{ asset('assets/styles/maincolors.css') }}" rel="stylesheet">
	<!-- LayerSlider CSS -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/layerslider/css/layerslider.css') }}">


	<!-- Switcher Only -->
	<link rel="stylesheet" id="switcher-css" type="text/css" href="{{ asset('assets/switcher/css/switcher.css') }}" media="all">
	<!-- END Switcher Styles -->

	<!-- Demo Examples (For Module #3) -->

	<link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/styles/maincolors.css') }}" title="maincolors" media="all">
	<link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/styles/kindergarten.css') }}" title="kindergarten" media="all">
	<link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/styles/playtime.css') }}" title="playtime" media="all">
	<link rel="alternate stylesheet" type="text/css" href="{{ asset('assets/styles/preschool.css') }}" title="preschool" media="all">

	<link rel="stylesheet" href="{{ asset('/assets/keyboard/jqkeyboard.css') }}" />

	<style>
		span.required {
			color: red;
		}
	</style>

	@if(App\Models\Site::settings()['custom_style'] != null)
		{!! App\Models\Site::settings()['custom_style'] !!}
	@endif

	@yield('header')
</head>
<!-- ==== body starts ==== -->

<body id="top">
	<div id="preloader">
		<div class="container h-100">
			<div class="row h-100 justify-content-center align-items-center">
				<div class="preloader-logo">
					<!-- spinner -->
					<div class="spinner">
						<div class="dot1"></div>
						<div class="dot2"></div>
					</div>
				</div>
				<!--/preloader logo -->
			</div>
			<!--/row -->
		</div>
		<!--/container -->
	</div>
	<!--/Preloader ends -->
	<nav id="main-nav" class="navbar-expand-xl">
		<div class="row">
			@if(App\Models\Site::settings()['hide_top_alert_bar'] == false)
			<!-- Start Top Bar -->
			<div class="container-fluid top-bar">
				<div class="container">
					@if(App\Models\Site::settings()['custom_top_alert_bar_text'] == null)
					<div class="row">
						<div class="col-md-9">
							<!-- Start Contact Info -->
							<ul class="contact-details float-left">
								@if(App\Models\Site::settings()['address'] != null)
								<li><i class="fa fa-map-marker"></i>{!! App\Models\Site::settings()['address'] !!}</li>
								@endif
								@if(App\Models\Site::settings()['support_email'] != null)
								<li><i class="fa fa-envelope"></i><a href="mailto:{{ App\Models\Site::settings()['address'] }}">{{ App\Models\Site::settings()['support_email'] }}</a></li>
								@endif
								@if(App\Models\Site::settings()['phone'] != null)
								<li><i class="fa fa-phone"></i>{{ App\Models\Site::settings()['phone'] }}</li>
								@endif
							</ul>
							<!-- End Contact Info -->
						</div>
						<!-- col -->
						<div class="col-md-3">
							<!-- Start Social Links -->
							<ul class="social-list float-end list-inline">
								@if(App\Models\Site::settings()['social_link_facebook'])
								<li class="list-inline-item"><a title="Facebook" href="{{ App\Models\Site::settings()['social_link_facebook'] }}"><i class="fab fa-facebook-f"></i></a></li>
								@endif
								@if(App\Models\Site::settings()['social_link_twitter'])
								<li class="list-inline-item"><a title="Twitter" href="{{ App\Models\Site::settings()['social_link_twitter'] }}"><i class="fab fa-twitter"></i></a></li>
								@endif
								@if(App\Models\Site::settings()['social_link_instagram'])
								<li class="list-inline-item"><a title="Instagram" href="{{ App\Models\Site::settings()['social_link_instagram'] }}"><i class="fab fa-instagram"></i></a></li>
								@endif
							</ul>
							<!-- /End Social Links -->
						</div>
						<!-- col -->
					</div>
					@else
					<div class="row" style="color: #fff;">
						<div class="col-12">
						{{ App\Models\Site::settings()['custom_top_alert_bar_text'] }}
						</div>
					</div>
					@endif
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- End Top bar -->
			 @endif

			<!-- Navbar Starts -->
			<div class="navbar container-fluid">
				<div class="container ">
					<!-- logo -->
					<a class="nav-brand text-muted h3" href="{{ route('get_index') }}">
						Alberta Hindi Parishad
					</a>
					<!-- Navbar toggler -->
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggle-icon">
							<i class="fas fa-bars"></i>
						</span>
					</button>
					<div class="collapse navbar-collapse" id="navbarResponsive">
						<ul class="navbar-nav ms-auto">
							<!-- menu item -->
							<li class="nav-item home-menu">
								<a class="nav-link" href="{{ route('get_index') }}">Home</a>
							</li>
							<!-- menu item -->
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="services-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Parishad
								</a>
								<div class="dropdown-menu" aria-labelledby="services-dropdown">
									<a class="dropdown-item" href="{{ route('get_mission') }}">Objective</a>
									<a class="dropdown-item" href="{{ route('get_team') }}">Board Memebrs</a>
								</div>
							</li>
							<!-- menu item -->
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="about-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Resources
								</a>
								<div class="dropdown-menu" aria-labelledby="about-dropdown">
									<a class="dropdown-item" href="{{ route('get_documents') }}">Documents</a>
									<a class="dropdown-item" href="{{ route('get_calendar') }}">Calendar</a>
									<a class="dropdown-item" href="{{ route('get_forms') }}">Forms</a>
									<a class="dropdown-item" href="{{ route('get_gallery') }}">Gallery</a>
									<a class="dropdown-item" href="{{ route('get_events') }}">Events</a>
								</div>
							</li>
							<!-- menu item -->
							<li class="nav-item home-menu"><a class="nav-link" href="{{ route('get_about') }}">About</a></li>
							<li class="nav-item home-menu"><a class="nav-link" href="{{ route('get_contact') }}">Contact Us</a></li>
							@if(Auth::check())
								<li class="nav-item home-menu"><a class="nav-link" href="{{ route('get_dashboard_index') }}">Dashboard ({{ Auth::user()->levelInfo() != null ? Auth::user()->levelInfo()->name : (Auth::user()->isUser() ? "User" : "Admin" )  }})</a></li>
							@else
								<li class="nav-item home-menu"><a class="nav-link" href="{{ route('get_admin_register_route') }}">Registration / Login</a></li>
							@endif
						</ul>
						<!--/ul -->
					</div>
					<!--collapse -->
				</div>
				<!-- /container -->
			</div>
			<!-- /navbar -->
		</div>
		<!--/row -->
	</nav>
	<!-- /nav -->
	<!-- page wrapper starts -->
	<div id="page-wrapper"><!-- ==== Slider ==== -->
		@yield('content')
	</div>
	<!--/ page-wrapper -->

	<div id="footer" class="footer-1 1-footer">
		<svg version="1.1" id="footer-divider" class="secondary" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1440 126" xml:space="preserve" preserveAspectRatio="none slice">
			<path class="st0" d="M685.6,38.8C418.7-11.1,170.2,9.9,0,30v96h1440V30C1252.7,52.2,1010,99.4,685.6,38.8z"></path>
		</svg>
		<!-- ==== footer ==== -->
		<footer class="bg-secondary text-light">
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-lg-4 text-center">
						<!-- logo -->
						<h3>Alberta Hindi Parishad</h3>
						<h5 class="mt-3">Subscribe to our newsletter</h5>
						<!-- Mailist Form -->
						<div id="mc_embed_signup">
							<!-- your mailist address in the line bellow -->
							<form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<div id="mc_embed_signup_scroll">
									<div class="mc-field-group">
										<div class="input-group">
											<input class="form-control input-lg required email" type="email" value="" name="EMAIL" placeholder="Your email here" id="mce-EMAIL">
											<span class="input-group-btn">
												<button class="btn btn-tertiary" type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe">Subscribe</button>
											</span>
										</div>
										<!-- Subscription results -->
										<div id="mce-responses" class="mailchimp">
											<div class="alert alert-danger response" id="mce-error-response"></div>
											<div class="alert alert-success response" id="mce-success-response"></div>
										</div>
									</div>
									<!-- /mc-fiel-group -->
								</div>
								<!-- /mc_embed_signup_scroll -->
							</form>
							<!-- /form ends -->
						</div>
						<!-- /mc_embed_signup -->
					</div>
					<!--/ col-lg -->
					<div class="col-lg-4 text-center res-margin">
						<h5>Contact Us</h5>
						<ul class="list-unstyled mt-3">
							@if(App\Models\Site::settings()['phone'] != null)
							<li class="mb-1"><i class="fas fa-phone margin-icon "></i>{{ App\Models\Site::settings()['phone'] }}</li>
							@endif
							@if(App\Models\Site::settings()['support_email'] != null)
							<li class="mb-1"><i class="fas fa-envelope margin-icon"></i><a href="mailto:{{ App\Models\Site::settings()['support_email'] }}">{{ App\Models\Site::settings()['support_email'] }}</a></li>
							@endif
							@if(App\Models\Site::settings()['address'] != null)
							<li><i class="fas fa-map-marker margin-icon"></i>{!! App\Models\Site::settings()['address'] !!}</li>
							@endif
						</ul>
						<!--/ul -->
						<!-- Start Social Links -->
						<ul class="social-list text-center list-inline mt-2">
							@if(App\Models\Site::settings()['social_link_facebook'])
							<li class="list-inline-item"><a title="Facebook" href="{{ App\Models\Site::settings()['social_link_facebook'] }}"><i class="fab fa-facebook-f"></i></a></li>
							@endif
							@if(App\Models\Site::settings()['social_link_twitter'])
							<li class="list-inline-item"><a title="Twitter" href="{{ App\Models\Site::settings()['social_link_twitter'] }}"><i class="fab fa-twitter"></i></a></li>
							@endif
							@if(App\Models\Site::settings()['social_link_instagram'])
							<li class="list-inline-item"><a title="Instagram" href="{{ App\Models\Site::settings()['social_link_instagram'] }}"><i class="fab fa-instagram"></i></a></li>
							@endif
						</ul>
						<!-- /End Social Links -->
					</div>
					<!--/ col-lg -->
					@if(App\Models\Site::settings()['working_hours_mon_thu'] != null || App\Models\Site::settings()['working_hours_friday'] != null)
					<div class="col-lg-4 text-center">
						<h5>Working Hours</h5>
						<ul class="list-unstyled mt-3">
							@if(App\Models\Site::settings()['working_hours_mon_thu'] != null)
							<li class="mb-1">Mon–Fri {{ App\Models\Site::settings()['working_hours_mon_thu'] }}</li>
							@endif
							@if(App\Models\Site::settings()['working_hours_friday'] != null)
							<li class="mb-1"> Sat–Sun {{ App\Models\Site::settings()['working_hours_friday'] }}</li>
							@endif
						</ul>
						<!--/ul -->
					</div>
					@endif
					<!--/ col-lg -->
				</div>
				<!--/ row-->
			</div>
			<!--/ container -->
			<!-- Go To Top Link -->
			<div class="d-none d-md-block">
				<a href="#top" class="back-to-top"><i class="fa fa-angle-up"></i></a>
			</div>
			<!--/page-scroll-->
		</footer>
		<!--/ footer-->
	</div>

	<div id="footer" class="footer-1 2-footer">
		<!-- ==== footer ==== -->
		<footer class="footer2 bg-secondary text-light">
			<!-- container -->
			<div class="container">
				<div class="col-lg-12 text-center">
					<!-- logo -->
					<img src="{{ asset('assets/img/logo_light.png') }}" class="logo-footer img-fluid" alt="">
				</div>
				<!-- row -->
				<div class="row mt-5">
					<div class="col-lg-4 text-center">
						<h5 class="mt-2">Subscribe to our newsletter</h5>
						<p>We send emails once a week</p>
						<!-- Mailist Form -->
						<div id="mc_embed_signup">
							<!-- your mailist address in the line bellow -->
							<form action="//listname.list-manage.com/subscribe/post?u=04e646927a196552aaee78a7b&amp;id=0dae358e08" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<div id="mc_embed_signup_scroll">
									<div class="mc-field-group">
										<div class="input-group">
											<input class="form-control input-lg required email" type="email" value="" name="EMAIL" placeholder="Your email here" id="mce-EMAIL">
											<span class="input-group-btn">
												<button class="btn btn-tertiary" type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe">Subscribe</button>
											</span>
										</div>
										<!-- Subscription results -->
										<div id="mce-responses" class="mailchimp">
											<div class="alert alert-danger response" id="mce-error-response"></div>
											<div class="alert alert-success response" id="mce-success-response"></div>
										</div>
									</div>
									<!-- /mc-fiel-group -->
								</div>
								<!-- /mc_embed_signup_scroll -->
							</form>
							<!-- /form ends -->
						</div>
						<!-- /mc_embed_signup -->
					</div>
					<!--/ col-lg -->
					<div class="col-lg-4 text-center res-margin">
						<h5>Contact Us</h5>
						<ul class="list-unstyled mt-3">
							<li class="mb-1"><i class="fas fa-phone margin-icon "></i>(123) 456-789</li>
							<li class="mb-1"><i class="fas fa-envelope margin-icon"></i><a href="mailto:email@yoursite.com">email@yoursite.com</a></li>
							<li><i class="fas fa-map-marker margin-icon"></i>Street Name 123 - New York </li>
						</ul>
						<!--/ul -->
					</div>
					<!--/ col-lg -->
					@if(App\Models\Site::settings()['working_hours_mon_thu'] != null || App\Models\Site::settings()['working_hours_friday'] != null)
					<div class="col-lg-4 text-center">
						<h5>Working Hours</h5>
						<ul class="list-unstyled mt-3">
							@if(App\Models\Site::settings()['working_hours_mon_thu'] != null)
							<li class="mb-1">Mon–Fri {{ App\Models\Site::settings()['working_hours_mon_thu'] }}</li>
							@endif
							@if(App\Models\Site::settings()['working_hours_friday'] != null)
							<li class="mb-1"> Sat–Sun {{ App\Models\Site::settings()['working_hours_friday'] }}</li>
							@endif
						</ul>
						<!--/ul -->
					</div>
					@endif
					<!--/ col-lg -->
				</div>
				<!--/ row-->
				<hr>
				<!-- col-md-12 -->
				<div class="col-md-12">
					<div class="credits row">
						<div class="col-md-6">
							<p class="float-left mt-3">Designed by <a href="http://www.ingridkuhn.com">Ingrid Kuhn</a></p>
						</div>
						<!--/col-md-6 -->
						<div class="col-md-6">
							<!-- Start Social Links -->
							<ul class="social-list float-end list-inline mb-0">
								<li class="list-inline-item"><a title="Facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li class="list-inline-item"><a title="Twitter" href="#"><i class="fab fa-twitter"></i></a></li>
								<li class="list-inline-item"><a title="Instagram" href="#"><i class="fab fa-instagram"></i></a></li>
							</ul>
							<!-- /End Social Links -->
						</div>
						<!--/col-md-6 -->
					</div>
					<!--/credits -->
				</div>
				<!--/col-md-12-->
			</div>
			<!--/ container -->
			<!-- Go To Top Link -->
			<div class="d-none d-md-block">
				<a href="#top" class="back-to-top"><i class="fa fa-angle-up"></i></a>
			</div>
			<!--/page-scroll-->
		</footer>
		<!--/ footer-->
	</div>


	<div id="footer" class="footer-1 3-footer">
		<!-- ==== footer ==== -->
		<footer class="footer3 bg-secondary text-light">
			<div class="container">
				<!-- row -->
				<div class="row mt-3">
					@if(App\Models\Site::settings()['working_hours_mon_thu'] != null || App\Models\Site::settings()['working_hours_friday'] != null)
					<div class="col-lg-4 text-center">
						<h5>Working Hours</h5>
						<ul class="list-unstyled mt-3">
							@if(App\Models\Site::settings()['working_hours_mon_thu'] != null)
							<li class="mb-1">Monday to Friday</li>
							<li class="mb-1">Open from {{ App\Models\Site::settings()['working_hours_mon_thu'] }}</li>
							@endif
							@if(App\Models\Site::settings()['working_hours_friday'] != null)
							<li class="mb-1">Holidays/Weekends - {{ App\Models\Site::settings()['working_hours_friday'] }}</li>
							@endif
						</ul>
						<!--/ul -->
					</div>
					@endif
					<!--/ col-lg -->
					<div class="col-lg-4 text-center">
						<!-- logo -->
						<img src="{{ asset('assets/img/logo_light.png') }}" class="logo-footer img-fluid" alt="">
						<p class="mt-4">Aliquam erat volutpat Aliquam erat volutpat In id fermentum augue, lorem ut pellentesque leo. Maecenas at arcu risus.</p>
					</div>
					<!--/ col-lg -->
					<div class="col-lg-4 text-center res-margin">
						<h5>Contact Us</h5>
						<ul class="list-unstyled mt-3">
							<li class="mb-1">(123) 456-789</li>
							<li class="mb-1"><a href="mailto:email@yoursite.com">email@yoursite.com</a></li>
							<li>Street Name 123 - New York </li>
						</ul>
						<!--/ul -->
					</div>
					<!--/ col-lg -->
					<div class="col-md-12">
						<!-- Start Social Links -->
						<ul class="social-list big-icons text-center list-inline mt-2">
							<li class="list-inline-item"><a title="Facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li class="list-inline-item"><a title="Twitter" href="#"><i class="fab fa-twitter"></i></a></li>
							<li class="list-inline-item"><a title="Instagram" href="#"><i class="fab fa-instagram"></i></a></li>
						</ul>
						<!-- /End Social Links -->
					</div>
					<!--/col-md-12 -->
				</div>
				<!--/ row-->
				<hr>
				<div class="row">
					<div class="credits col-sm-12">
						<p>Designed by <a href="http://www.ingridkuhn.com">Ingrid Kuhn</a></p>
					</div>
					<!--/credits -->
				</div>
				<!--/row-->
			</div>
			<!--/ container -->
			<!-- Go To Top Link -->
			<div class="d-none d-md-block">
				<a href="#top" class="back-to-top"><i class="fa fa-angle-up"></i></a>
			</div>
			<!--/page-scroll-->
		</footer>
		<!--/ footer-->
	</div>


	<!-- Bootstrap core & Jquery -->
	<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

	<!-- Custom Js -->
	<script src="{{ asset('assets/js/custom.js') }}"></script>
	<script src="{{ asset('assets/js/plugins.js') }}"></script>
	<!-- Prefix free -->
	<script src="{{ asset('assets/js/prefixfree.min.js') }}"></script>
	<!-- Bootstrap Select Tool (For Module #4) -->
	<script src="{{ asset('assets/switcher/js/bootstrap-select.js') }}"></script>
	<!-- All Scripts & Plugins -->
	<script src="{{ asset('assets/switcher/js/dmss.js') }}"></script>
	<script src="{{ asset('assets/switcher/js/extrastyles.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.4/js.cookie.min.js"></script>



	<!-- number counter script -->
	<script src="{{ asset('assets/js/counter.js') }}"></script>
	<!-- maps -->
	<script src="{{ asset('assets/js/map.js') }}"></script>
	<!-- GreenSock -->
	<script src="{{ asset('assets/vendor/layerslider/js/greensock.js') }}"></script>
	<!-- LayerSlider script files -->
	<script src="{{ asset('assets/vendor/layerslider/js/layerslider.transitions.js') }}"></script>
	<script src="{{ asset('assets/vendor/layerslider/js/layerslider.kreaturamedia.jquery.js') }}"></script>
	<script src="{{ asset('assets/vendor/layerslider/js/layerslider.load.js') }}"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script>
        $(".moment_time").each(function(){
            var _e_time = $(this).text();
            var _time = moment.unix(_e_time);
            var _title = _time.format("DD-MMMM-YYYY h:mm:ss a");
            $(this).attr("title", _title);
            $(this).text(_time.fromNow());
        });
    </script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js" integrity="sha512-Ww1y9OuQ2kehgVWSD/3nhgfrb424O3802QYP/A5gPXoM4+rRjiKrjHdGxQKrMGQykmsJ/86oGdHszfcVgUr4hA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="{{ asset('/assets/keyboard/jqkeyboard-min.js') }}"></script>
	<script src="{{ asset('/assets/keyboard/jqk.layout.en.js') }}"></script>
	<script src="{{ asset('/assets/keyboard/jqk.layout.bg.js') }}"></script>

	<script>
		$(function () {
			"use strict";

			jqKeyboard.init();
		});
	</script>

	@if(App\Models\Site::settings()['analytics_code'] != null)
	{!! App\Models\Site::settings()['analytics_code'] !!}
	@endif

	@if(App\Models\Site::settings()['custom_script'] != null)
	{!! App\Models\Site::settings()['custom_script'] !!}
	@endif
	
	@yield('footer')
</body>

</html>